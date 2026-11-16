@extends('layouts.admin')

@section('title', 'Manage Education')
@section('page-title', 'Education & Qualifications')
@section('page-subtitle', 'Add and organize academic degrees and courses.')

@section('page-actions')
    <a href="{{ route('admin.education.create') }}" class="btn btn-primary btn-sm">
        + Add Qualification
    </a>
@endsection

@section('content')
<div class="admin-card">
    @if($educations->isEmpty())
        <div class="empty-state">
            <p>No educational credentials added yet.</p>
            <a href="{{ route('admin.education.create') }}" class="btn btn-primary btn-sm" style="margin-top: 1rem;">Add First Qualification</a>
        </div>
    @else
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Institution</th>
                        <th>Degree</th>
                        <th>Field</th>
                        <th>Years</th>
                        <th>Grade</th>
                        <th>Visible</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($educations as $edu)
                        <tr>
                            <td><strong>{{ $edu->institution }}</strong></td>
                            <td>{{ $edu->degree }}</td>
                            <td>{{ $edu->field_of_study ?? '-' }}</td>
                            <td>
                                <span class="badge" style="background: rgba(255,255,255,0.05); color: var(--text-secondary);">
                                    {{ $edu->year_range }}
                                </span>
                            </td>
                            <td>{{ $edu->grade ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $edu->is_visible ? 'badge-success' : 'badge-danger' }}">
                                    {{ $edu->is_visible ? 'Visible' : 'Hidden' }}
                                </span>
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('admin.education.edit', $edu) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.education.destroy', $edu) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" data-confirm="Delete this education entry?" title="Delete">
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
            {{ $educations->links() }}
        </div>
    @endif
</div>
@endsection
