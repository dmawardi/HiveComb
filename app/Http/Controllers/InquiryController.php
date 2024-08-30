<?php

namespace App\Http\Controllers;

use App\Mail\InquiryReceived;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    /**
     * Display a listing of the inquiries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquiries = Inquiry::all();
        return view('inquiries.index', ['inquiries' => $inquiries]);
    }

    /**
     * Show the form for creating a new inquiry.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inquiries.create');
    }

     /**
     * Store a newly created inquiry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'type' => 'required|in:general,quote,support,partnership',
            'message' => 'required|string',
        ]);
        // Set the status to unread
        $request->merge(['status' => 'unread']);
        // Create a new inquiry
        $inquiry = Inquiry::create($request->all());

        // Send an email
        Mail::to(env('ADMIN_EMAIL'))->queue(new InquiryReceived($inquiry));

        return redirect()->route('inquiries.create')->with('success', 'Inquiry created successfully.');;
    }

    /**
     * Display the specified inquiry.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $inquiry)
    {
        return view('inquiries.show', ['inquiry' => $inquiry]);
    }

    /**
     * Show the form for editing the specified inquiry.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Inquiry $inquiry)
    {
        return view('inquiries.edit', ['inquiry' => $inquiry]);
    }

    /**
     * Update the specified inquiry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email',
            'phone' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'type' => 'sometimes|required|in:general,quote,support,partnership',
            'message' => 'sometimes|required|string',
            'status' => 'sometimes|in:unread,read,archived,in progress,resolved,closed',
        ]);
        $inquiry->update($request->all());
        return redirect()->route('inquiries.index')->with('success', 'Inquiry updated successfully.');
    }
    
    /**
     * Remove the specified inquiry from storage.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
