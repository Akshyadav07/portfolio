@extends('layouts.admin')

@section('title', 'Manage Projects')
@section('page-title', 'Projects Showcase')
@section('page-subtitle', 'Add, manage, and present your featured and portfolio works.')

@section('page-actions')
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
        + Create Project
    </a>
@endsection

@section('content')
<div class="admin-card">
    @if($projects->isEmpty())
        <div class="empty-state">
            <p>No projects created yet.</p>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm" style="margin-top: 1rem;">Create First Project</a>
        </div>
    @else
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Links</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td style="width: 80px;">
                                <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border);">
                            </td>
                            <td>
                                <strong>{{ $project->title }}</strong>
                                <div style="font-size: 11px; color: var(--text-muted);">/projects/{{ $project->slug }}</div>
                            </td>
                            <td>
                                @if($project->is_featured)
                                    <span class="badge badge-purple">Featured</span>
                                @else
                                    <span class="badge" style="background: rgba(255,255,255,0.05); color: var(--text-muted);">Standard</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $project->is_visible ? 'badge-success' : 'badge-danger' }}">
                                    {{ $project->is_visible ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 6px;">
                                    @if($project->live_url)
                                        <a href="{{ $project->live_url }}" target="_blank" class="tag" style="padding: 2px 6px;">Live</a>
                                    @endif
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="tag" style="padding: 2px 6px;">Repo</a>
                                    @endif
                                </div>
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="btn btn-secondary btn-sm btn-icon" title="View Frontend Page">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" data-confirm="Are you sure you want to delete this project?" title="Delete">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="admin-pagination">
            {{ $projects->links() }}
        </div>
    @endif
</div>
@endsection
