<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

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
            'website' => 'nullable|string|max:255',
            'type' => 'required|in:general,quote,support,partnership',
            'message' => 'required|string',
            'status' => 'sometimes|in:unread,read,archived,in progress,resolved,closed',
        ]);
        // Create a new inquiry
        Inquiry::create($request->all());
        return redirect()->route('inquiries.index')->with('success', 'Inquiry created successfully.');;
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
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
