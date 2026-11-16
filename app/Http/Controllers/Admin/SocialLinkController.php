<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::orderBy('display_order')->paginate(15);

        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform'      => 'required|string|max:255',
            'url'           => 'required|url|max:500',
            'icon'          => 'nullable|string|max:255',
            'color'         => 'nullable|string|max:50',
            'display_order' => 'nullable|integer',
            'is_visible'    => 'boolean',
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');

        SocialLink::create($validated);

        return redirect()->route('admin.social-links.index')->with('success', 'Social link created successfully.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform'      => 'required|string|max:255',
            'url'           => 'required|url|max:500',
            'icon'          => 'nullable|string|max:255',
            'color'         => 'nullable|string|max:50',
            'display_order' => 'nullable|integer',
            'is_visible'    => 'boolean',
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');

        $socialLink->update($validated);

        return redirect()->route('admin.social-links.index')->with('success', 'Social link updated successfully.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')->with('success', 'Social link deleted successfully.');
    }
}
