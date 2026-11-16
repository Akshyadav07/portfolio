@extends('layouts.admin')

@section('title', 'Website Settings')
@section('page-title', 'Portfolio Settings')
@section('page-subtitle', 'Configure site title, SEO descriptions, brand logos, and contact information.')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Website Title</label>
                <input type="text" name="site_title" class="form-control" value="{{ old('site_title', $settings['site_title'] ?? '') }}" placeholder="Developer Portfolio">
                @error('site_title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Contact Notification Email</label>
                <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" placeholder="you@domain.com">
                @error('contact_email') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Hero Tagline</label>
            <input type="text" name="hero_tagline" class="form-control" value="{{ old('hero_tagline', $settings['hero_tagline'] ?? '') }}" placeholder="Building the web, one line at a time.">
            @error('hero_tagline') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Site Meta Description (SEO)</label>
            <textarea name="site_description" class="form-control" rows="3" placeholder="Search engine description preview...">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
            @error('site_description') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Meta Keywords (SEO)</label>
            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}" placeholder="PHP, Laravel, MySQL, Developer">
            @error('meta_keywords') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Footer Copyright Notice</label>
            <input type="text" name="footer_text" class="form-control" value="{{ old('footer_text', $settings['footer_text'] ?? '') }}" placeholder="&copy; 2026 Developer Name. All rights reserved.">
            @error('footer_text') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Website Logo</label>
                <input type="file" name="logo" class="form-control" accept="image/jpeg,image/png,image/webp,image/svg+xml">
                <span class="form-hint">Accepted formats: SVG, PNG, JPG</span>
                @if(!empty($settings['logo']))
                    <div style="margin-top: 8px;">
                        <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" style="max-height: 40px; background: rgba(255,255,255,0.05); padding: 4px; border-radius: 4px;">
                    </div>
                @endif
                @error('logo') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Website Favicon</label>
                <input type="file" name="favicon" class="form-control" accept="image/x-icon,image/png,image/svg+xml">
                <span class="form-hint">Accepted formats: ICO, PNG, SVG</span>
                @if(!empty($settings['favicon']))
                    <div style="margin-top: 8px;">
                        <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon" style="max-height: 32px;">
                    </div>
                @endif
                @error('favicon') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
    </form>
</div>
@endsection
