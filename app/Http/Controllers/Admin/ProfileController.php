<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrNew(['id' => 1]);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'designation'         => 'required|string|max:255',
            'short_intro'         => 'nullable|string',
            'about_description'   => 'nullable|string',
            'email'               => 'nullable|email|max:255',
            'phone'               => 'nullable|string|max:50',
            'location'            => 'nullable|string|max:255',
            'github_url'          => 'nullable|url|max:500',
            'linkedin_url'        => 'nullable|url|max:500',
            'twitter_url'         => 'nullable|url|max:500',
            'is_available'        => 'boolean',
            'years_of_experience' => 'nullable|integer|min:0',
            'projects_completed'  => 'nullable|integer|min:0',
            'clients_served'      => 'nullable|integer|min:0',
            'profile_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'resume'              => 'nullable|mimes:pdf|max:10240',
        ]);

        $profile = Profile::firstOrNew(['id' => 1]);

        if ($request->hasFile('profile_image')) {
            $old = $profile->profile_image;
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $validated['profile_image'] = Storage::disk('public')->put('profiles', $request->file('profile_image'));
        }

        if ($request->hasFile('resume')) {
            $old = $profile->resume;
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $validated['resume'] = Storage::disk('public')->put('resumes', $request->file('resume'));
        }

        $validated['is_available'] = $request->boolean('is_available');

        $profile->fill($validated);
        $profile->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
