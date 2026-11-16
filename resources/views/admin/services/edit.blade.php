@extends('layouts.admin')

@section('title', 'Edit Service: ' . $service->title)
@section('page-title', 'Edit Service')
@section('page-subtitle', 'Update service offering details and styling.')

@section('content')
<div class="admin-card" style="max-width: 700px;">
    <form action="{{ route('admin.services.update', $service) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Service Title <span class="required">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}" required>
            @error('title') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Service Description <span class="required">*</span></label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $service->description) }}</textarea>
            @error('description') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Icon Identifier</label>
                <select name="icon" class="form-control">
                    <option value="server" {{ old('icon', $service->icon) == 'server' ? 'selected' : '' }}>Server / Backend</option>
                    <option value="globe" {{ old('icon', $service->icon) == 'globe' ? 'selected' : '' }}>Web / Full Stack</option>
                    <option value="database" {{ old('icon', $service->icon) == 'database' ? 'selected' : '' }}>Database / Storage</option>
                    <option value="api" {{ old('icon', $service->icon) == 'api' ? 'selected' : '' }}>API Integration</option>
                    <option value="code" {{ old('icon', $service->icon) == 'code' ? 'selected' : '' }}>Custom Software</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Accent Color Hex</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $service->color) }}">
                @error('color') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $service->display_order) }}" min="0">
            </div>

            <div class="form-group" style="justify-content: flex-end;">
                <label class="form-check">
                    <input type="checkbox" name="is_visible" value="1" class="form-check-input" {{ old('is_visible', $service->is_visible) ? 'checked' : '' }}>
                    <span class="form-check-label">Display on Frontend</span>
                </label>
            </div>
        </div>

        <div style="display:flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
