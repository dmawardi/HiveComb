<?php

namespace App\Orchid\Screens;

use App\Models\Project;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProjectListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request): iterable
    { // Build a query to fetch inquiries
        $query = Project::query();
  
        // If a search query is present, filter the inquiries
        if ($request->filled('search')) {
            // Validate the search term
            $request->validate([
                'search' => 'required|string|max:255',
            ]);
            // Get the search term from the request
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->orWhere('url', 'like', "%{$search}%")
            ->orWhere('client_name', 'like', "%{$search}%")
            ->orWhere('technologies', 'like', "%{$search}%");
        }

        // Apply filters
        if ($request->filled('filter')) {
            $filters = $request->input('filter');

            if (!empty($filters['status'])) {
                $query->whereIn('status', $filters['status']);
            }
            if (!empty($filters['featured'])) {
                $featFilters = $filters['featured'];
                $query->whereIn('featured', $featFilters);

            }
            // Handle completion_date range filter
            if (!empty($filters['completion_date'])) {
                $dates = $filters['completion_date'];
                $query->whereBetween('completion_date', [$dates['start'], $dates['end']]);
            }
        }
        // Fetch paginated inquiries
        $projects = $query->paginate();

        return [
            'projects' => $projects,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Projects';
    }

     /**
        * The description is displayed on the user's screen under the heading
        */
        public function description(): ?string
        {
            return 'Projects that were worked on by HiveComb';
        }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add Project')
            ->modal('projectModal')
            ->method('create')
            ->icon('plus'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            // Search bar
            Layout::rows([
                Input::make('search')
                    ->type('text')
                    ->placeholder('Search...')
                    ->value(request()->query('search')),
                Button::make('Search')
                    ->method('handleSearch')  // Assuming you handle the request in a method called `search`
                    ->type(Color::SUCCESS())
                    ->icon('magnifier')
            ]),
            // Table of projects
            Layout::table('projects', [
                TD::make('name')
                ->render(function (Project $item) {
                    return Link::make($item->name)
                        ->route('platform.projects.edit', $item);
                }),
                TD::make('url'),
                TD::make('client_name'),
                TD::make('status')
                ->filter(TD::FILTER_SELECT, [
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'archived' => 'Archived',
                    ])
                    ->render(function (Project $item) {
                        return $item->status;
                    }),
                TD::make('featured')
                ->filter(TD::FILTER_SELECT, [
                    '0' => 'No',
                    '1' => 'Yes',
                    ])
                    ->render(function (Project $item) {
                        return $item->featured? 'Yes' : 'No';
                    }),
                TD::make('completion_date', 'Completion Date')
                ->filter(TD::FILTER_DATE_RANGE)
                ->render(function (Project $item) {
                    return $item->completion_date ? $item->completion_date->format('Y-m-d') : '';
                }),
                    
                // Actions column
                TD::make('Actions')
                ->alignRight()
                ->render(function (Project $item) {
                    return Button::make('Delete Project')
                        ->confirm('After deleting, the project will be gone forever.')
                        ->method('delete', ['project' => $item->id]);
                }),
            ]),

            // Modal form to create a new project
            Layout::modal('projectModal', Layout::rows([
                Input::make('project.name')
                    ->title('Name')
                    ->placeholder('Enter name for project')
                    ->help('The name of the project to be created.'),
                Input::make('project.url')
                    ->title('URL')
                    ->placeholder('Enter URL')
                    ->help('The URL of the project.'),
                Input::make('project.client_name')
                    ->title('Client Name')
                    ->placeholder('Enter client name')
                    ->help('The client name of the project.'),
                DateTimer::make('project.completion_date')
                    ->title('Completion Date')
                    ->placeholder('Click to select a date')
                    ->help('The completion date of the project.')
                    ->format('Y-m-d'),  // You can change the format as needed
                Input::make('project.technologies')
                    ->title('Technologies')
                    ->placeholder('Enter technologies')
                    ->help('The technologies used in the project.'),
                Upload::make('project.thumbnail_image')
                    ->title('Thumbnail Image')
                    ->acceptedFiles('image/*') // Specify accepted file types
                    ->maxFiles(1) // Limit the number of files that can be uploaded
                    ->help('Upload the thumbnail image of the project.'),
                Select::make('project.status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'archived' => 'Archived',
                    ])
                    ->title('Type')
                    ->help('The status of the project.'),
                CheckBox::make('project.featured')
                    ->title('Featured')
                    ->placeholder('Is this project featured?')
                    ->help('Whether the project is featured or not.'),
            ]))
                ->title('Create Project')
                ->applyButton('Add Project'),
        ];
    }

  /**
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function create(Request $request)
    {
        // Get the 'project' array from the request, or default to an empty array if not set
        $projectData = $request->input('project', []);

        // Update the 'featured' key within the 'project' array
        $projectData['featured'] = $request->has('project.featured');

        // Merge the modified 'project' array back into the request
        $request->merge(['project' => $projectData]);

        // Validate form data, save task to database, etc.
        $request->validate([
            'project.name' => 'required|max:255',
            'project.url' => 'nullable|url',
            'project.client_name' => 'nullable|max:255',
            'project.completion_date' => 'nullable|date',
            'project.technologies' => 'nullable|max:255',
            'project.thumbnail_image' => 'nullable',
            'project.gallery_images' => 'nullable|url',
            'project.status' => 'required|in:active,inactive,archived',
            'project.featured' => 'required|boolean',
        ]);

        // Handle file uploads
        if ($request->hasFile('project.thumbnail_image')) {
            $baseFilePath = $request->file('project.thumbnail_image')->store('public');
            $projectData['thumbnail_image'] = $baseFilePath;
        }


        $project = Project::create([
            'name' => $request->input('project.name'),
            'url' => $request->input('project.url'),
            'client_name' => $request->input('project.client_name'),
            'completion_date' => $request->input('project.completion_date'),
            'technologies' => $request->input('project.technologies'),
            'thumbnail_image' => $request->input('project.thumbnail_image')[0],
            'status' => $request->input('project.status'),
            'featured' => $request->boolean('project.featured'),
        ]);

        Alert::info('You have successfully created a project.');

        return redirect()->route('platform.projects.list');
    }

    /**
     * @param Project $project
     *
     * @return void
     */
    public function delete(Project $project)
    {
        // Grab file from thumbnail image and delete it
        $attachment = Attachment::find($project->thumbnail_image);
        if ($attachment) {
            $attachment->delete();
        }
        // Delete the project
        $project->delete();
        Alert::info('You have successfully deleted a project: ' . $project->name);
        return redirect()->route('platform.projects.list');
    }

    /**
     * Search button handler
     */
     // Used as button handler to reroute to the same page with search values saved
     public function handleSearch(Request $request)
     {
         // Get the search term from the request
         $searchTerm = $request->input('search');

         // Redirect back to the screen with the search parameter to show results
         return redirect()->route('platform.projects.list', ['search' => $searchTerm]);
     }
}
