<?php

namespace App\Orchid\Screens;

use App\Models\Inquiry;
use Illuminate\Http\Client\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class InquiryScreen extends Screen
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
        ]);

        $inquiry = new Inquiry();
        $inquiry->name = $request->input('inquiry.name');
        $inquiry->save();
    }

    /**
     * @param Task $task
     *
     * @return void
     */
    public function delete(Inquiry $inquiry)
    {
        $inquiry->delete();
    }

            
        /**
         * Fetch data to be displayed on the screen.
         *
         * @return array
         */
        public function query(): iterable
        {
            $inquiries = Inquiry::latest()->get();
            // dd($inquiries);
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

        /**
         * The screen's layout elements.
         *
         * @return \Orchid\Screen\Layout[]|string[]
         */
        public function layout(): iterable
        {
            return [
                // Table of inquiries
                Layout::table('inquiries', [
                    TD::make('name'),
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
                        ->placeholder('Enter inquiry name')
                        ->help('The name of the inquiry to be created.'),
                ]))
                    ->title('Create Inquiry')
                    ->applyButton('Add Inquiry'),
            ];
        }
    }
