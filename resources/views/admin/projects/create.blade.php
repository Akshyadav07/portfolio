@extends('layouts.admin')

@section('title', 'Add New Project')
@section('page-title', 'Create Project')
@section('page-subtitle', 'Add a portfolio project with descriptions, tags, and media.')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Project Title <span class="required">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. AI-Powered SaaS Analytics" required>
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Short Summary</label>
                <input type="text" name="short_description" class="form-control" value="{{ old('short_description') }}" placeholder="One sentence highlight card summary">
                @error('short_description') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Full Project Overview / Story <span class="required">*</span></label>
            <textarea name="description" class="form-control" rows="6" placeholder="Describe the problem, architectural solutions, and tech stack details..." required>{{ old('description') }}</textarea>
            @error('description') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Technologies (Comma separated)</label>
            <input type="text" name="technologies" class="form-control" value="{{ is_array(old('technologies')) ? implode(', ', old('technologies')) : old('technologies') }}" placeholder="e.g. PHP, Laravel, MySQL, JavaScript">
            <span class="form-hint">Type technologies separated by commas (e.g. PHP, Laravel, MySQL)</span>
            @error('technologies') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">GitHub Repository URL</label>
                <input type="url" name="github_url" class="form-control" value="{{ old('github_url') }}" placeholder="https://github.com/user/repo">
                @error('github_url') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Live Deployment URL</label>
                <input type="url" name="live_url" class="form-control" value="{{ old('live_url') }}" placeholder="https://mycoolapp.com">
                @error('live_url') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Cover / Thumbnail Image</label>
                <input type="file" name="thumbnail" class="form-control" accept="image/jpeg,image/png,image/webp" data-preview="thumbPreview">
                <span class="form-hint">Main preview image on cards (Max: 5MB)</span>
                @error('thumbnail') <span class="form-error">{{ $message }}</span> @enderror
                <div class="img-preview-container" style="margin-top: 8px;">
                    <img id="thumbPreview" src="" class="img-preview" alt="Preview" style="display:none; width: 140px; height: 90px;">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Gallery Showcase Screenshots (Multiple)</label>
                <input type="file" name="images[]" class="form-control" accept="image/jpeg,image/png,image/webp" multiple>
                <span class="form-hint">Select multiple screenshots for details showcase</span>
                @error('images.*') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', 0) }}" min="0">
            </div>

            <div class="form-group" style="justify-content: center; gap: 1rem;">
                <label class="form-check">
                    <input type="checkbox" name="is_featured" value="1" class="form-check-input" {{ old('is_featured') ? 'checked' : '' }}>
                    <span class="form-check-label">Feature this project prominently</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', true) ? 'checked' : '' }}>
                    <span class="form-check-label">Publish immediately on portfolio</span>
                </label>
            </div>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Create Project</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
