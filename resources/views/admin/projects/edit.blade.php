@extends('layouts.admin')

@section('title', 'Edit Project: ' . $project->title)
@section('page-title', 'Edit Project')
@section('page-subtitle', 'Update media, details, and gallery items.')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Project Title <span class="required">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $project->title) }}" required>
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Short Summary</label>
                <input type="text" name="short_description" class="form-control" value="{{ old('short_description', $project->short_description) }}">
                @error('short_description') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Full Project Overview / Story <span class="required">*</span></label>
            <textarea name="description" class="form-control" rows="6" required>{{ old('description', $project->description) }}</textarea>
            @error('description') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Technologies (Comma separated)</label>
            @php
                $techVal = old('technologies', is_array($project->technologies) ? implode(', ', $project->technologies) : $project->technologies);
                if (is_array($techVal)) {
                    $techVal = implode(', ', $techVal);
                }
            @endphp
            <input type="text" name="technologies" class="form-control" value="{{ $techVal }}" placeholder="e.g. PHP, Laravel, MySQL, JavaScript">
            <span class="form-hint">Type technologies separated by commas (e.g. PHP, Laravel, MySQL)</span>
            @error('technologies') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">GitHub Repository URL</label>
                <input type="url" name="github_url" class="form-control" value="{{ old('github_url', $project->github_url) }}">
                @error('github_url') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Live Deployment URL</label>
                <input type="url" name="live_url" class="form-control" value="{{ old('live_url', $project->live_url) }}">
                @error('live_url') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Cover / Thumbnail Image</label>
                <input type="file" name="thumbnail" class="form-control" accept="image/jpeg,image/png,image/webp" data-preview="thumbPreview">
                <span class="form-hint">Upload replacement to overwrite current thumbnail (Max: 5MB)</span>
                @error('thumbnail') <span class="form-error">{{ $message }}</span> @enderror
                <div class="img-preview-container" style="margin-top: 8px;">
                    <img id="thumbPreview" src="{{ $project->thumbnail ? asset('storage/' . $project->thumbnail) : asset('assets/images/default-project.png') }}" class="img-preview" alt="Preview" style="width: 140px; height: 90px;">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Upload Additional Gallery Screenshots</label>
                <input type="file" name="images[]" class="form-control" accept="image/jpeg,image/png,image/webp" multiple>
                <span class="form-hint">Append more screenshots to the showcase gallery</span>
                @error('images.*') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $project->display_order) }}" min="0">
            </div>

            <div class="form-group" style="justify-content: center; gap: 1rem;">
                <label class="form-check">
                    <input type="checkbox" name="is_featured" value="1" class="form-check-input" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                    <span class="form-check-label">Feature this project prominently</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', $project->is_visible) ? 'checked' : '' }}>
                    <span class="form-check-label">Published on frontend</span>
                </label>
            </div>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@if($project->images && $project->images->count() > 0)
    <div class="admin-card" style="margin-top: 2rem;">
        <h3 class="card-title">Existing Gallery Images</h3>
        <p class="card-subtitle">Manage or remove individual project screenshots.</p>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem;">
            @foreach($project->images as $img)
                <div style="position: relative; border: 1px solid var(--border); border-radius: 8px; overflow: hidden; background: var(--card-bg);">
                    <img src="{{ $img->image_url }}" alt="Screenshot" style="width: 100%; height: 110px; object-fit: cover; display: block;">
                    <div style="padding: 8px; text-align: center;">
                        <form action="{{ route('admin.projects.images.destroy', [$project, $img]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" data-confirm="Delete this screenshot?" style="width: 100%;">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection
