@extends('layouts.admin')

@section('title', 'Edit Skill: ' . $skill->name)
@section('page-title', 'Edit Skill')
@section('page-subtitle', 'Update technical capability details and level.')

@section('content')
<div class="admin-card" style="max-width: 700px;">
    <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Skill Name <span class="required">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $skill->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Category <span class="required">*</span></label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $skill->category) }}" required>
                @error('category') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Proficiency Level (1 - 100): <span id="levelDisplay">{{ $skill->level }}%</span> <span class="required">*</span></label>
                <input type="range" id="skillLevel" name="level" class="form-control" min="1" max="100" value="{{ old('level', $skill->level) }}">
                @error('level') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Brand Color Hex</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $skill->color) }}" placeholder="#8B5CF6">
                @error('color') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $skill->display_order) }}" min="0">
                @error('display_order') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="justify-content: flex-end;">
                <label class="form-check">
                    <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', $skill->is_visible) ? 'checked' : '' }}>
                    <span class="form-check-label">Display on Frontend</span>
                </label>
            </div>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Skill</button>
            <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
