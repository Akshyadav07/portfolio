<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'technologies'      => 'nullable',
            'github_url'        => 'nullable|url|max:500',
            'live_url'          => 'nullable|url|max:500',
            'is_featured'       => 'boolean',
            'is_visible'        => 'boolean',
            'display_order'     => 'nullable|integer',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images'            => 'nullable|array',
            'images.*'          => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible']  = $request->boolean('is_visible');
        $validated['slug']        = $this->uniqueSlug($request->title);

        if (!empty($validated['technologies'])) {
            if (is_string($validated['technologies'])) {
                // If user entered comma-separated string or json string
                $decoded = json_decode($validated['technologies'], true);
                if (is_array($decoded)) {
                    $validated['technologies'] = $decoded;
                } else {
                    $validated['technologies'] = array_values(array_filter(array_map('trim', explode(',', $validated['technologies']))));
                }
            }
        } else {
            $validated['technologies'] = [];
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = Storage::disk('public')->put('projects/thumbnails', $request->file('thumbnail'));
        }

        $project = Project::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('public')->put('projects/images', $image);
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'technologies'      => 'nullable',
            'github_url'        => 'nullable|url|max:500',
            'live_url'          => 'nullable|url|max:500',
            'is_featured'       => 'boolean',
            'is_visible'        => 'boolean',
            'display_order'     => 'nullable|integer',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images'            => 'nullable|array',
            'images.*'          => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible']  = $request->boolean('is_visible');

        if (!empty($validated['technologies'])) {
            if (is_string($validated['technologies'])) {
                $decoded = json_decode($validated['technologies'], true);
                if (is_array($decoded)) {
                    $validated['technologies'] = $decoded;
                } else {
                    $validated['technologies'] = array_values(array_filter(array_map('trim', explode(',', $validated['technologies']))));
                }
            }
        } else {
            $validated['technologies'] = [];
        }

        if ($request->hasFile('thumbnail')) {
            $old = $project->thumbnail;
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $validated['thumbnail'] = Storage::disk('public')->put('projects/thumbnails', $request->file('thumbnail'));
        }

        $project->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('public')->put('projects/images', $image);
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $old = $project->thumbnail;
        if ($old && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }

        foreach ($project->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function deleteImage(Project $project, ProjectImage $image)
    {
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    protected function uniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug  = Str::slug($title);
        $base  = $slug;
        $count = 1;

        while (
            Project::where('slug', $slug)
                ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }
}
