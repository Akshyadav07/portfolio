@extends('layouts.admin')

@section('title', 'Edit Experience: ' . $experience->company)
@section('page-title', 'Edit Experience')
@section('page-subtitle', 'Update role details and employment timeline.')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Company Name <span class="required">*</span></label>
                <input type="text" name="company" class="form-control" value="{{ old('company', $experience->company) }}" required>
                @error('company') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Position / Title <span class="required">*</span></label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $experience->position) }}" required>
                @error('position') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Employment Type</label>
                <input type="text" name="employment_type" class="form-control" value="{{ old('employment_type', $experience->employment_type) }}">
                @error('employment_type') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $experience->location) }}">
                @error('location') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Start Date <span class="required">*</span></label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $experience->start_date ? $experience->start_date->format('Y-m-d') : '') }}" required>
                @error('start_date') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}">
                <span class="form-hint">Leave blank if currently working here</span>
                @error('end_date') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="is_current" value="1" class="form-check-input" {{ old('is_current', $experience->is_current) ? 'checked' : '' }}>
                <span class="form-check-label">Currently Working Here</span>
            </label>
        </div>

        <div class="form-group">
            <label class="form-label">Short Description</label>
            <textarea name="description" class="form-control" rows="2">{{ old('description', $experience->description) }}</textarea>
            @error('description') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Key Responsibilities (One item per line)</label>
            <textarea name="responsibilities" class="form-control" rows="5">{{ old('responsibilities', is_array($experience->responsibilities) ? implode("\n", $experience->responsibilities) : '') }}</textarea>
            @error('responsibilities') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Company Website URL</label>
                <input type="url" name="company_url" class="form-control" value="{{ old('company_url', $experience->company_url) }}">
                @error('company_url') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $experience->display_order) }}" min="0">
            </div>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', $experience->is_visible) ? 'checked' : '' }}>
                <span class="form-check-label">Display on Frontend Portfolio</span>
            </label>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
