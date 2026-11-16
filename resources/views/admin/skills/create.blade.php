@extends('layouts.admin')

@section('title', 'Add New Skill')
@section('page-title', 'Create Skill')
@section('page-subtitle', 'Add a new technical competence to your portfolio.')

@section('content')
<div class="admin-card" style="max-width: 700px;">
    <form action="{{ route('admin.skills.store') }}" method="POST" class="admin-form">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Skill Name <span class="required">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Laravel" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Category <span class="required">*</span></label>
                <input type="text" name="category" class="form-control" value="{{ old('category', 'Backend') }}" placeholder="e.g. Backend, Frontend, DevOps" required>
                @error('category') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Proficiency Level (1 - 100): <span id="levelDisplay">85%</span> <span class="required">*</span></label>
                <input type="range" id="skillLevel" name="level" class="form-control" min="1" max="100" value="{{ old('level', 85) }}">
                @error('level') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Brand Color Hex</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', '#8B5CF6') }}" placeholder="#8B5CF6">
                @error('color') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', 0) }}" min="0">
                @error('display_order') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="justify-content: flex-end;">
                <label class="form-check">
                    <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', true) ? 'checked' : '' }}>
                    <span class="form-check-label">Display on Frontend</span>
                </label>
            </div>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Create Skill</button>
            <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
