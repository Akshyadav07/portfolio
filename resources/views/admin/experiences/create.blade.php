@extends('layouts.admin')

@section('title', 'Add Work Experience')
@section('page-title', 'Create Experience')
@section('page-subtitle', 'Add professional employment experience details.')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.experiences.store') }}" method="POST" class="admin-form">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Company Name <span class="required">*</span></label>
                <input type="text" name="company" class="form-control" value="{{ old('company') }}" placeholder="e.g. Acme Tech Labs" required>
                @error('company') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Position / Title <span class="required">*</span></label>
                <input type="text" name="position" class="form-control" value="{{ old('position') }}" placeholder="e.g. Lead Laravel Architect" required>
                @error('position') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Employment Type</label>
                <input type="text" name="employment_type" class="form-control" value="{{ old('employment_type') }}" placeholder="Full-time, Contract, Internship">
                @error('employment_type') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}" placeholder="Remote or City, Country">
                @error('location') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Start Date <span class="required">*</span></label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                @error('start_date') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                <span class="form-hint">Leave empty if this is your current position</span>
                @error('end_date') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="is_current" value="1" class="form-check-input" {{ old('is_current') ? 'checked' : '' }}>
                <span class="form-check-label">Currently Working Here</span>
            </label>
        </div>

        <div class="form-group">
            <label class="form-label">Short Description</label>
            <textarea name="description" class="form-control" rows="2" placeholder="Brief overview of role and accomplishments">{{ old('description') }}</textarea>
            @error('description') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Key Responsibilities (One item per line)</label>
            <textarea name="responsibilities" class="form-control" rows="5" placeholder="Engineered microservices with Laravel
Designed high-throughput MySQL schemas
Led API integrations for third-party billing">{{ old('responsibilities') }}</textarea>
            @error('responsibilities') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Company Website URL</label>
                <input type="url" name="company_url" class="form-control" value="{{ old('company_url') }}" placeholder="https://company.com">
                @error('company_url') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', 0) }}" min="0">
            </div>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', true) ? 'checked' : '' }}>
                <span class="form-check-label">Display on Frontend Portfolio</span>
            </label>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Experience</button>
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
