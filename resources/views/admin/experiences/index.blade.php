@extends('layouts.admin')

@section('title', 'Manage Work Experience')
@section('page-title', 'Work Experience')
@section('page-subtitle', 'Add and manage employment records, positions, and responsibilities.')

@section('page-actions')
    <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary btn-sm">
        + Add Experience
    </a>
@endsection

@section('content')
<div class="admin-card">
    @if($experiences->isEmpty())
        <div class="empty-state">
            <p>No work experience added yet.</p>
            <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary btn-sm" style="margin-top: 1rem;">Add First Experience</a>
        </div>
    @else
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Position</th>
                        <th>Duration</th>
                        <th>Type</th>
                        <th>Visible</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($experiences as $exp)
                        <tr>
                            <td>
                                <strong>{{ $exp->company }}</strong>
                                @if($exp->location)
                                    <div style="font-size: 11px; color: var(--text-muted);">{{ $exp->location }}</div>
                                @endif
                            </td>
                            <td>{{ $exp->position }}</td>
                            <td>
                                <span class="badge" style="background: rgba(255,255,255,0.05); color: var(--text-secondary);">
                                    {{ $exp->duration }}
                                </span>
                            </td>
                            <td>
                                @if($exp->employment_type)
                                    <span class="tag">{{ $exp->employment_type }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $exp->is_visible ? 'badge-success' : 'badge-danger' }}">
                                    {{ $exp->is_visible ? 'Visible' : 'Hidden' }}
                                </span>
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('admin.experiences.edit', $exp) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" data-confirm="Are you sure you want to delete this experience record?" title="Delete">
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
            {{ $experiences->links() }}
        </div>
    @endif
</div>
@endsection
