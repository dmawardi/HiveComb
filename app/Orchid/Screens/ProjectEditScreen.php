<?php

namespace App\Orchid\Screens;

use App\Models\Project;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProjectEditScreen extends Screen
{
    /**
     * @var Project
     */
    public $project;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Project $project): iterable
    {
        $file = Attachment::where('id', $project->thumbnail_image)->first();
        return [
            'project' => $project,
            'thumbnail_image' => $file,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->project->exists ? 'Edit post' : 'Creating a new post';
    }

     /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Project details and settings.";
    }

     /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request)
    {
        // Get the 'project' array from the request, or default to an empty array if not set
        $projectData = $request->input('project', []);

        // Update the 'featured' key within the 'project' array
        $projectData['featured'] = $request->has('project.featured');

         // Delete the old thumbnail image if none found in the request
         if ($request->has('project.thumbnail_image') && $request->input('project.thumbnail_image') === null) {
            // Find the attached image and delete
            $attachment = Attachment::find($this->project->thumbnail_image);
            if ($attachment) {
                $attachment->delete();
            }
            // Set the thumbnail image to null
            $projectData['thumbnail_image'] = null;
        }

        // Merge the modified 'project' array back into the request
        $request->merge(['project' => $projectData]);

         // Validate form data, save task to database, etc.
         $request->validate([
            'project.name' => 'required|max:255',
            'project.description' => 'nullable',
            'project.url' => 'nullable',
            'project.client_name' => 'nullable',
            'project.completion_date' => 'nullable',
            'project.technologies' => 'nullable',
            'project.thumbnail_image' => 'nullable',
            'project.gallery_images' => 'nullable',
            'project.status' => 'required|in:active,inactive,archived',
            'project.featured' => 'required|boolean',
        ]);

        // Handle file uploads
        if ($request->hasFile('project.thumbnail_image')) {
            $baseFilePath = $request->file('project.thumbnail_image')->store('public');
            $projectData['thumbnail_image'] = $baseFilePath;
        }
       

        $this->project->fill([
            'name' => $request->input('project.name'),
            'description' => $request->input('project.description'),
            'url' => $request->input('project.url'),
            'client_name' => $request->input('project.client_name'),
            'completion_date' => $request->input('project.completion_date'),
            'technologies' => $request->input('project.technologies'),
            'thumbnail_image' => $request->input('project.thumbnail_image'),
            'gallery_images' => $request->input('project.gallery_images'),
            'status' => $request->input('project.status'),
            'featured' => $request->input('project.featured'),
        ])->save();

        Alert::info('You have successfully edited a project.');

        return redirect()->route('platform.projects.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        // Grab file from thumbnail image and delete it
        $attachment = Attachment::find($this->project->thumbnail_image);
        if ($attachment) {
            $attachment->delete();
        }

        // Delete the project
        $this->project->delete();

        Alert::info('You have successfully deleted the project.');

        return redirect()->route('platform.projects.list');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create project')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->project->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->project->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->project->exists),
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
            Layout::rows([
                Input::make('project.name')
                    ->title('Name')
                    ->placeholder('Project name')
                    ->help('Enter the name of the project')
                    ->required()
                    ->value($this->project->name),
                Input::make('project.description')
                    ->title('Description')
                    ->placeholder('Project description')
                    ->help('Enter a description of the project')
                    ->value($this->project->description),
                Input::make('project.url')
                    ->title('URL')
                    ->placeholder('Project URL')
                    ->help('Enter the URL of the project')
                    ->value($this->project->url),
                Input::make('project.client_name')
                    ->title('Client Name')
                    ->placeholder('Client name')
                    ->help('Enter the name of the client')
                    ->value($this->project->client_name),
                Input::make('project.completion_date')
                    ->title('Completion Date')
                    ->placeholder('Completion date')
                    ->help('Enter the completion date of the project')
                    ->value($this->project->completion_date),
                Input::make('project.technologies')
                    ->title('Technologies')
                    ->placeholder('Technologies used')
                    ->help('Enter the technologies used in the project')
                    ->value($this->project->technologies),
                Upload::make('project.thumbnail_image')
                    ->title('Thumbnail Image')
                    ->placeholder('Thumbnail image')
                    ->help('Upload the thumbnail image of the project')
                    ->value(fn() => $this->project['thumbnail_image']),
                Select::make('project.status')
                    ->title('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'archived' => 'Archived',
                    ])
                    ->value($this->project->status),
                Select::make('project.featured')
                    ->title('Featured')
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No',
                    ])
                    ->value($this->project->featured),
            ])
        ];
    }
}
