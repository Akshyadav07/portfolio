@extends('layouts.admin')

@section('title', 'Add Social Link')
@section('page-title', 'Create Social Link')
@section('page-subtitle', 'Add platform connection to your profile.')

@section('content')
<div class="admin-card" style="max-width: 650px;">
    <form action="{{ route('admin.social-links.store') }}" method="POST" class="admin-form">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Platform Name <span class="required">*</span></label>
                <input type="text" name="platform" class="form-control" value="{{ old('platform') }}" placeholder="GitHub, LinkedIn, Twitter, Discord..." required>
                @error('platform') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Profile / Page URL <span class="required">*</span></label>
                <input type="url" name="url" class="form-control" value="{{ old('url') }}" placeholder="https://..." required>
                @error('url') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Brand Color Hex</label>
                <input type="text" name="color" class="form-control" value="{{ old('color') }}" placeholder="#0A66C2">
                @error('color') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', 0) }}" min="0">
            </div>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', true) ? 'checked' : '' }}>
                <span class="form-check-label">Display in Header & Footer</span>
            </label>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Link</button>
            <a href="{{ route('admin.social-links.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
