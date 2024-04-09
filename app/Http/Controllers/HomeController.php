<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Return last 3 projects
        $projects = Project::latest()->take(3)->get();
        return view('welcome', [
            'projects' => $projects,
        ]);
    }
}
