<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects'   => Project::count(),
            'total_skills'     => Skill::count(),
            'total_messages'   => Message::count(),
            'unread_messages'  => Message::unread()->count(),
            'total_experience' => Experience::count(),
            'total_education'  => Education::count(),
        ];
        $recentProjects = Project::latest()->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentMessages'));
    }
}
