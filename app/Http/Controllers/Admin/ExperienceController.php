<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('display_order')->paginate(10);

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company'         => 'required|string|max:255',
            'position'        => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:100',
            'start_date'      => 'required|date',
            'end_date'        => 'nullable|date|after_or_equal:start_date',
            'is_current'      => 'boolean',
            'description'     => 'nullable|string',
            'responsibilities'=> 'nullable|string',
            'company_url'     => 'nullable|url|max:500',
            'location'        => 'nullable|string|max:255',
            'display_order'   => 'nullable|integer',
            'is_visible'      => 'boolean',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_visible'] = $request->boolean('is_visible');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        if (isset($validated['responsibilities']) && $validated['responsibilities'] !== null) {
            $lines = array_values(array_filter(array_map('trim', explode("\n", $validated['responsibilities']))));
            $validated['responsibilities'] = $lines;
        }

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience created successfully.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company'         => 'required|string|max:255',
            'position'        => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:100',
            'start_date'      => 'required|date',
            'end_date'        => 'nullable|date|after_or_equal:start_date',
            'is_current'      => 'boolean',
            'description'     => 'nullable|string',
            'responsibilities'=> 'nullable|string',
            'company_url'     => 'nullable|url|max:500',
            'location'        => 'nullable|string|max:255',
            'display_order'   => 'nullable|integer',
            'is_visible'      => 'boolean',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_visible'] = $request->boolean('is_visible');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        if (isset($validated['responsibilities']) && $validated['responsibilities'] !== null) {
            $lines = array_values(array_filter(array_map('trim', explode("\n", $validated['responsibilities']))));
            $validated['responsibilities'] = $lines;
        }

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted successfully.');
    }
}
