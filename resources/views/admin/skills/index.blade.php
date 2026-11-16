@extends('layouts.admin')

@section('title', 'Manage Skills')
@section('page-title', 'Technical Skills')
@section('page-subtitle', 'Manage your technical skillset, proficiency ratings, and order.')

@section('page-actions')
    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm">
        + Add New Skill
    </a>
@endsection

@section('content')
<div class="admin-card">
    @if($skills->isEmpty())
        <div class="empty-state">
            <p>No skills recorded yet.</p>
            <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm" style="margin-top: 1rem;">Add First Skill</a>
        </div>
    @else
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Skill Name</th>
                        <th>Category</th>
                        <th>Proficiency Level</th>
                        <th>Color</th>
                        <th>Visible</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $skill)
                        <tr>
                            <td>{{ $skill->display_order }}</td>
                            <td><strong>{{ $skill->name }}</strong></td>
                            <td><span class="tag">{{ $skill->category }}</span></td>
                            <td style="min-width: 150px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div class="skill-level-bar" style="flex: 1;">
                                        <div class="skill-level-fill" style="width: {{ $skill->level }}%;"></div>
                                    </div>
                                    <span>{{ $skill->level }}%</span>
                                </div>
                            </td>
                            <td>
                                @if($skill->color)
                                    <span style="display:inline-block; width:14px; height:14px; border-radius:50%; background:{{ $skill->color }}; vertical-align:middle; margin-right:4px;"></span>
                                    <span>{{ $skill->color }}</span>
                                @else
                                    <span class="text-muted">Default</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $skill->is_visible ? 'badge-success' : 'badge-danger' }}">
                                    {{ $skill->is_visible ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" data-confirm="Are you sure you want to delete this skill?" title="Delete">
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
            {{ $skills->links() }}
        </div>
    @endif
</div>
@endsection
