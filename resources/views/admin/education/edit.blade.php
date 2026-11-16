@extends('layouts.admin')

@section('title', 'Edit Education: ' . $education->degree)
@section('page-title', 'Edit Qualification')
@section('page-subtitle', 'Update university, year range, and program credentials.')

@section('content')
<div class="admin-card" style="max-width: 800px;">
    <form action="{{ route('admin.education.update', $education) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Institution / University <span class="required">*</span></label>
                <input type="text" name="institution" class="form-control" value="{{ old('institution', $education->institution) }}" required>
                @error('institution') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Degree <span class="required">*</span></label>
                <input type="text" name="degree" class="form-control" value="{{ old('degree', $education->degree) }}" required>
                @error('degree') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Field of Study</label>
                <input type="text" name="field_of_study" class="form-control" value="{{ old('field_of_study', $education->field_of_study) }}">
                @error('field_of_study') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Grade / GPA / Honors</label>
                <input type="text" name="grade" class="form-control" value="{{ old('grade', $education->grade) }}">
                @error('grade') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Start Year (YYYY) <span class="required">*</span></label>
                <input type="number" name="start_year" class="form-control" value="{{ old('start_year', $education->start_year) }}" min="1970" max="2099" required>
                @error('start_year') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">End Year (YYYY)</label>
                <input type="number" name="end_year" class="form-control" value="{{ old('end_year', $education->end_year) }}" min="1970" max="2099">
                <span class="form-hint">Leave blank if currently enrolled</span>
                @error('end_year') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="is_current" value="1" class="form-check-input" {{ old('is_current', $education->is_current) ? 'checked' : '' }}>
                <span class="form-check-label">Currently Enrolled / In Progress</span>
            </label>
        </div>

        <div class="form-group">
            <label class="form-label">Description / Achievements</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $education->description) }}</textarea>
            @error('description') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $education->display_order) }}" min="0">
            </div>

            <div class="form-group" style="justify-content: flex-end;">
                <label class="form-check">
                    <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', $education->is_visible) ? 'checked' : '' }}>
                    <span class="form-check-label">Display on Frontend Portfolio</span>
                </label>
            </div>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('admin.education.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
