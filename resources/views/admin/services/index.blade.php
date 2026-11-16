@extends('layouts.admin')

@section('title', 'Manage Services')
@section('page-title', 'Offered Services')
@section('page-subtitle', 'Add and organize the software & development services you offer.')

@section('page-actions')
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
        + Add Service
    </a>
@endsection

@section('content')
<div class="admin-card">
    @if($services->isEmpty())
        <div class="empty-state">
            <p>No services registered yet.</p>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm" style="margin-top: 1rem;">Add First Service</a>
        </div>
    @else
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Icon ID</th>
                        <th>Color</th>
                        <th>Visible</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $svc)
                        <tr>
                            <td><strong>{{ $svc->title }}</strong></td>
                            <td style="max-width: 320px; color: var(--text-secondary);">{{ Str::limit($svc->description, 80) }}</td>
                            <td><span class="tag">{{ $svc->icon ?? 'default' }}</span></td>
                            <td>
                                @if($svc->color)
                                    <span style="display:inline-block; width:14px; height:14px; border-radius:50%; background:{{ $svc->color }}; vertical-align:middle; margin-right:4px;"></span>
                                    <span>{{ $svc->color }}</span>
                                @else
                                    <span class="text-muted">Default</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $svc->is_visible ? 'badge-success' : 'badge-danger' }}">
                                    {{ $svc->is_visible ? 'Visible' : 'Hidden' }}
                                </span>
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('admin.services.edit', $svc) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.services.destroy', $svc) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" data-confirm="Delete this service?" title="Delete">
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
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection
