<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::simplepaginate(6);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'client_name' => 'required|string|max:255',
            'completion_date' => 'required|date',
            'technologies' => 'required|string',
            'thumbnail_image' => 'required|image',
            'status' => 'required|in:active,inactive,archived',
            'featured' => 'required|boolean',
        ]);
        // Store the image in the public directory: thumbnails
        $baseFilePath = request()->file('thumbnail')->store('thumbnails');
        // Update the thumbnail path in the attributes
        $attributes['thumbnail'] = $baseFilePath;

        // Create a new project
        Project::create($attributes);
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');;
    }

    /**
     * Display the specified project.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'url' => 'sometimes|url',
            'client_name' => 'sometimes|string|max:255',
            'completion_date' => 'sometimes|date',
            'technologies' => 'sometimes|string',
            'thumbnail_image' => 'sometimes|url',
            'status' => 'sometimes|in:active,inactive,archived',
            'featured' => 'sometimes|boolean',
        ]);
        $project->update($request->all());
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }

    /**
     * Archive the specified project.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function archive(Project $project)
    {
        $project->update(['status' => 'archived']);
        return redirect()->route('projects.index');
    }

    /**
     * Restore the specified project.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function restore(Project $project)
    {
        $project->update(['status' => 'active']);
        return redirect()->route('projects.index');
    }
}
