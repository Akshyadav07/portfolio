@extends('layouts.admin')

@section('title', 'Manage Social Links')
@section('page-title', 'Social Profiles & Links')
@section('page-subtitle', 'Manage links to GitHub, LinkedIn, Twitter, and other online presences.')

@section('page-actions')
    <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary btn-sm">
        + Add Social Link
    </a>
@endsection

@section('content')
<div class="admin-card">
    @if($socialLinks->isEmpty())
        <div class="empty-state">
            <p>No social profile links created yet.</p>
            <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary btn-sm" style="margin-top: 1rem;">Add First Link</a>
        </div>
    @else
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Platform</th>
                        <th>URL</th>
                        <th>Color</th>
                        <th>Visible</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($socialLinks as $link)
                        <tr>
                            <td><strong>{{ $link->platform }}</strong></td>
                            <td><a href="{{ $link->url }}" target="_blank" style="color: var(--accent); font-size: var(--font-sm);">{{ $link->url }}</a></td>
                            <td>
                                @if($link->color)
                                    <span style="display:inline-block; width:14px; height:14px; border-radius:50%; background:{{ $link->color }}; vertical-align:middle; margin-right:4px;"></span>
                                    <span>{{ $link->color }}</span>
                                @else
                                    <span class="text-muted">Default</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $link->is_visible ? 'badge-success' : 'badge-danger' }}">
                                    {{ $link->is_visible ? 'Visible' : 'Hidden' }}
                                </span>
                            </td>
                            <td>{{ $link->display_order }}</td>
                            <td class="table-actions">
                                <a href="{{ route('admin.social-links.edit', $link) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" data-confirm="Delete this social link?" title="Delete">
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
            {{ $socialLinks->links() }}
        </div>
    @endif
</div>
@endsection
