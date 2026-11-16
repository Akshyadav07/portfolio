<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)
            ->where('is_visible', true)
            ->with('images')
            ->firstOrFail();

        $relatedProjects = Project::visible()
            ->where('id', '!=', $project->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('frontend.project-details', compact('project', 'relatedProjects'));
    }
}
