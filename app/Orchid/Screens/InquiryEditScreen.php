<?php

namespace App\Orchid\Screens;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class InquiryEditScreen extends Screen
{
    /**
     * @var Inquiry
     */
    public $inquiry;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param Inquiry $inquiry
     * @return array
     */
    public function query(Inquiry $inquiry): iterable
    {
        return [
            'inquiry' => $inquiry,
        ];
    }

     /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request)
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

        $this->inquiry->fill([
            'name' => $request->input('inquiry.name'),
            'email' => $request->input('inquiry.email'),
            'phone' => $request->input('inquiry.phone'),
            'company_name' => $request->input('inquiry.company_name'),
            'website' => $request->input('inquiry.website'),
            'type' => $request->input('inquiry.type'),
            'status' => $request->input('inquiry.status'),
            'message' => $request->input('inquiry.message'),
        ])->save();

        Alert::info('You have successfully edited an inquiry.');

        return redirect()->route('platform.inquiries.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->inquiry->delete();

        Alert::info('You have successfully deleted the inquiry.');

        return redirect()->route('platform.inquiries.list');
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->inquiry->exists ? 'Edit post' : 'Creating a new post';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Inquiries";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create post')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->inquiry->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->inquiry->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->inquiry->exists),
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
                Input::make('inquiry.name')
                    ->title('Name')
                    ->placeholder('John Doe')
                    ->help('Specify the name of the person who made the inquiry')
                    ->required(),

                Input::make('inquiry.email')
                    ->title('Email')
                    ->placeholder('email@domain.com')
                    ->help('Enter the email address of the person who made the inquiry')
                    ->required(),
                Input::make('inquiry.phone')
                    ->title('Phone')
                    ->placeholder('310-666-6666')
                    ->help('Enter the phone number of the person who made the inquiry'),
                Input::make('inquiry.company_name')
                    ->title('Company Name')
                    ->placeholder('Company Name')
                    ->help('Enter the name of the company of the person who made the inquiry'),
                Input::make('inquiry.website')
                    ->title('Website')
                    ->placeholder('https://www.domain.com')
                    ->help('Enter the website of the company of the person who made the inquiry'),
                Select::make('inquiry.type')
                    ->title('Type')
                    ->options([
                        'general' => 'General',
                        'quote' => 'Quote',
                        'support' => 'Support',
                        'partnership' => 'Partnership',
                    ])
                    ->help('Select the type of inquiry')
                    ->required(),
                Input::make('inquiry.message')
                    ->title('Message')
                    ->placeholder('Enter message')
                    ->help('Enter the message of the inquiry')
                    ->required(),
                Select::make('inquiry.status')
                    ->title('Status')
                    ->options([
                        'unread' => 'Unread',
                        'read' => 'Read',
                        'archived' => 'Archived',
                        'in progress' => 'In Progress',
                        'resolved' => 'Resolved',
                        'closed' => 'Closed',
                    ])
                    ->help('Select the status of the inquiry')
                    ->required(),
            ]),
        ];
    }
}
