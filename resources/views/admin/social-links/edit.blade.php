@extends('layouts.admin')

@section('title', 'Edit Social Link: ' . $socialLink->platform)
@section('page-title', 'Edit Social Link')
@section('page-subtitle', 'Update destination URL and display options.')

@section('content')
<div class="admin-card" style="max-width: 650px;">
    <form action="{{ route('admin.social-links.update', $socialLink) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Platform Name <span class="required">*</span></label>
                <input type="text" name="platform" class="form-control" value="{{ old('platform', $socialLink->platform) }}" required>
                @error('platform') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Profile / Page URL <span class="required">*</span></label>
                <input type="url" name="url" class="form-control" value="{{ old('url', $socialLink->url) }}" required>
                @error('url') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Brand Color Hex</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $socialLink->color) }}">
                @error('color') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $socialLink->display_order) }}" min="0">
            </div>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', $socialLink->is_visible) ? 'checked' : '' }}>
                <span class="form-check-label">Display in Header & Footer</span>
            </label>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('admin.social-links.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
