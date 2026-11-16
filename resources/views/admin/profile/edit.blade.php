@extends('layouts.admin')

@section('title', 'Manage Profile')
@section('page-title', 'Profile Information')
@section('page-subtitle', 'Edit your primary portfolio bio, contacts, and resume.')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Full Name <span class="required">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $profile->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Primary Designation <span class="required">*</span></label>
                <input type="text" name="designation" class="form-control" value="{{ old('designation', $profile->designation) }}" placeholder="e.g. Senior PHP Laravel Developer" required>
                @error('designation') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Hero Introduction Tagline</label>
            <textarea name="short_intro" class="form-control" rows="2" placeholder="Brief 1-2 sentence hook">{{ old('short_intro', $profile->short_intro) }}</textarea>
            @error('short_intro') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">About Me Full Biography</label>
            <textarea name="about_description" class="form-control" rows="5" placeholder="Detailed professional background">{{ old('about_description', $profile->about_description) }}</textarea>
            @error('about_description') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $profile->email) }}">
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->phone) }}">
                @error('phone') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Physical Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $profile->location) }}" placeholder="City, Country">
                @error('location') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">GitHub URL</label>
                <input type="url" name="github_url" class="form-control" value="{{ old('github_url', $profile->github_url) }}">
                @error('github_url') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $profile->linkedin_url) }}">
                @error('linkedin_url') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Twitter / X URL</label>
                <input type="url" name="twitter_url" class="form-control" value="{{ old('twitter_url', $profile->twitter_url) }}">
                @error('twitter_url') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Years of Experience</label>
                <input type="number" name="years_of_experience" class="form-control" value="{{ old('years_of_experience', $profile->years_of_experience) }}" min="0">
                @error('years_of_experience') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Completed Projects</label>
                <input type="number" name="projects_completed" class="form-control" value="{{ old('projects_completed', $profile->projects_completed) }}" min="0">
                @error('projects_completed') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Clients Served</label>
                <input type="number" name="clients_served" class="form-control" value="{{ old('clients_served', $profile->clients_served) }}" min="0">
                @error('clients_served') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Profile Avatar Image</label>
                <input type="file" name="profile_image" class="form-control" accept="image/jpeg,image/png,image/webp" data-preview="profilePreview">
                <span class="form-hint">Accepted formats: JPG, PNG, WEBP (Max: 5MB)</span>
                @error('profile_image') <span class="form-error">{{ $message }}</span> @enderror

                <div class="img-preview-container" style="margin-top: 10px;">
                    <img id="profilePreview" src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('assets/images/default-profile.png') }}" class="img-preview" alt="Preview">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Resume Document (PDF)</label>
                <input type="file" name="resume" class="form-control" accept="application/pdf">
                <span class="form-hint">Upload updated resume in PDF format (Max: 10MB)</span>
                @error('resume') <span class="form-error">{{ $message }}</span> @enderror

                @if($profile->resume)
                    <div style="margin-top: 10px;">
                        <a href="{{ asset('storage/' . $profile->resume) }}" target="_blank" class="btn btn-secondary btn-sm">
                            View Current Resume PDF
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label class="form-check">
                <input type="checkbox" name="is_available" value="1" class="form-check-input" {{ old('is_available', $profile->is_available) ? 'checked' : '' }}>
                <span class="form-check-label">Available for Hire (Shows status badge on frontend)</span>
            </label>
        </div>

        <div style="margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Profile Changes</button>
        </div>
    </form>
</div>
@endsection
