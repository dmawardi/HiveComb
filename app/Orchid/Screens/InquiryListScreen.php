<?php

namespace App\Orchid\Screens;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class InquiryListScreen extends Screen
{

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function create(Request $request)
    {
        // Validate form data, save task to database, etc.
        $request->validate([
            'inquiry.name' => 'required|max:255',
            'inquiry.email' => 'required|email',
            'inquiry.phone' => 'nullable',
            'inquiry.company_name' => 'nullable',
            'inquiry.website' => 'nullable',
            'inquiry.type' => 'required|in:general,quote,support,partnership',
            'inquiry.status' => 'required|in:unread,read,archived,in progress,resolved,closed',
            'inquiry.message' => 'required',
        ]);

        $inquiry = Inquiry::create([
            'name' => $request->input('inquiry.name'),
            'email' => $request->input('inquiry.email'),
            'phone' => $request->input('inquiry.phone'),
            'company_name' => $request->input('inquiry.company_name'),
            'website' => $request->input('inquiry.website'),
            'type' => $request->input('inquiry.type'),
            'status' => $request->input('inquiry.status'),
            'message' => $request->input('inquiry.message'),
        ]);
        return redirect()->route('platform.inquiries.list');
    }

    /**
     * @param Inquiry $inquiry
     *
     * @return void
     */
    public function delete(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('platform.inquiries.list');
    }

            
        /**
         * Fetch data to be displayed on the screen.
         *
         * @return array
         */
        public function query(Request $request): iterable
        {
            // Build a query to fetch inquiries
            $query = Inquiry::query();
      
            // If a search query is present, filter the inquiries
            if ($request->filled('search')) {
                // Validate the search term
                $request->validate([
                    'search' => 'required|string|max:255',
                ]);
                // Get the search term from the request
                $search = $request->input('search');
                $query->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('company_name', 'like', "%{$search}%")
                ->orWhere('website', 'like', "%{$search}%")
                ->orWhere('message', 'like', "%{$search}%");
            }
            // Fetch paginated inquiries
            $inquiries = $query->paginate();

            return [
                'inquiries' => $inquiries,
            ];
        }

        /**
         * The name of the screen displayed in the header.
         *
         * @return string|null
         */
        public function name(): ?string
        {
            return 'Inquiries';
        }

        /**
        * The description is displayed on the user's screen under the heading
        */
        public function description(): ?string
        {
            return 'Orchid Quickstart';
        }

        /**
         * The screen's action buttons.
         *
         * @return \Orchid\Screen\Action[]
         */
        public function commandBar(): iterable
        {
            return [
                ModalToggle::make('Add Inquiry')
                ->modal('inquiryModal')
                ->method('create')
                ->icon('plus'),
            ];
        }

        // Used as button handler to reroute to the same page with search values saved
        public function handleSearch(Request $request)
        {
            // Get the search term from the request
            $searchTerm = $request->input('search');

            // Redirect back to the screen with the search parameter to show results
            return redirect()->route('platform.inquiries.list', ['search' => $searchTerm]);
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
                // Table of inquiries
                Layout::table('inquiries', [
                    TD::make('name')
                    ->render(function (Inquiry $inquiry) {
                        return Link::make($inquiry->name)
                            ->route('platform.inquiries.edit', $inquiry);
                    }),
                    TD::make('email'),
                    TD::make('company_name'),
                    TD::make('type'),
                    TD::make('status'),

                    // Actions column
                    TD::make('Actions')
                    ->alignRight()
                    ->render(function (Inquiry $inquiry) {
                        return Button::make('Delete Inquiry')
                            ->confirm('After deleting, the inquiry will be gone forever.')
                            ->method('delete', ['inquiry' => $inquiry->id]);
                    }),
                ]),

                // Modal form to create a new inquiry
                Layout::modal('inquiryModal', Layout::rows([
                    Input::make('inquiry.name')
                        ->title('Name')
                        ->placeholder('Enter name for inquirer')
                        ->help('The name of the inquiry to be created.'),
                    Input::make('inquiry.message')->title('Message')
                        ->placeholder('Enter inquiry message')
                        ->help('The message of the inquiry.'),
                    Input::make('inquiry.email')
                        ->title('Email')
                        ->placeholder('Enter email address')
                        ->help('The email address of the inquiry.'),
                    Input::make('inquiry.phone')
                        ->title('Phone')
                        ->placeholder('Enter phone number')
                        ->help('The phone number of the inquiry.'),
                    Input::make('inquiry.company_name')
                        ->title('Company Name')
                        ->placeholder('Enter company name')
                        ->help('The name of the company associated with the inquiry.'),
                    Input::make('inquiry.website')
                        ->title('Website')
                        ->placeholder('Enter website URL')
                        ->help('The website URL of the company.'),
                    Select::make('inquiry.type')
                        ->options([
                            'general' => 'General',
                            'quote' => 'Quote',
                            'support' => 'Support',
                            'partnership' => 'Partnership'
                        ])
                        ->title('Type')
                        ->help('The type of inquiry.'),
                    Select::make('inquiry.status')
                        ->options([
                            'unread' => 'Unread',
                            'read' => 'Read',
                            'archived' => 'Archived',
                            'in progress' => 'In Progress',
                            'resolved' => 'Resolved',
                            'closed' => 'Closed'
                        ])
                        ->title('Status')
                        ->help('The status of the inquiry.'),
                ]))
                    ->title('Create Inquiry')
                    ->applyButton('Add Inquiry'),
            ];
        }
    }
