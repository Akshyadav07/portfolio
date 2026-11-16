<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('display_order')->paginate(10);

        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution'   => 'required|string|max:255',
            'degree'        => 'required|string|max:255',
            'field_of_study'=> 'nullable|string|max:255',
            'start_year'    => 'required|digits:4|integer',
            'end_year'      => 'nullable|digits:4|integer|gte:start_year',
            'is_current'    => 'boolean',
            'description'   => 'nullable|string',
            'grade'         => 'nullable|string|max:100',
            'display_order' => 'nullable|integer',
            'is_visible'    => 'boolean',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_visible'] = $request->boolean('is_visible');

        if ($validated['is_current']) {
            $validated['end_year'] = null;
        }

        Education::create($validated);

        return redirect()->route('admin.educations.index')->with('success', 'Education created successfully.');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'institution'   => 'required|string|max:255',
            'degree'        => 'required|string|max:255',
            'field_of_study'=> 'nullable|string|max:255',
            'start_year'    => 'required|digits:4|integer',
            'end_year'      => 'nullable|digits:4|integer|gte:start_year',
            'is_current'    => 'boolean',
            'description'   => 'nullable|string',
            'grade'         => 'nullable|string|max:100',
            'display_order' => 'nullable|integer',
            'is_visible'    => 'boolean',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_visible'] = $request->boolean('is_visible');

        if ($validated['is_current']) {
            $validated['end_year'] = null;
        }

        $education->update($validated);

        return redirect()->route('admin.educations.index')->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('admin.educations.index')->with('success', 'Education deleted successfully.');
    }
}
