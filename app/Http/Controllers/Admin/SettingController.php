<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    protected array $settingKeys = [
        'site_title',
        'site_description',
        'footer_text',
        'hero_tagline',
        'contact_email',
        'meta_keywords',
        'logo',
        'favicon',
        'resume_file',
    ];

    public function edit()
    {
        $settings = Setting::getMany($this->settingKeys);

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_title'       => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'footer_text'      => 'nullable|string',
            'hero_tagline'     => 'nullable|string|max:500',
            'contact_email'    => 'nullable|email|max:255',
            'meta_keywords'    => 'nullable|string',
            'logo'             => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',
            'favicon'          => 'nullable|image|mimes:jpg,jpeg,png,webp,ico',
            'resume_file'      => 'nullable|mimes:pdf',
        ]);

        $textKeys = [
            'site_title',
            'site_description',
            'footer_text',
            'hero_tagline',
            'contact_email',
            'meta_keywords',
        ];

        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        if ($request->hasFile('logo')) {
            $old = Setting::get('logo');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $path = Storage::disk('public')->put('settings', $request->file('logo'));
            Setting::set('logo', $path);
        }

        if ($request->hasFile('favicon')) {
            $old = Setting::get('favicon');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $path = Storage::disk('public')->put('settings', $request->file('favicon'));
            Setting::set('favicon', $path);
        }

        if ($request->hasFile('resume_file')) {
            $old = Setting::get('resume_file');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $path = Storage::disk('public')->put('settings', $request->file('resume_file'));
            Setting::set('resume_file', $path);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
