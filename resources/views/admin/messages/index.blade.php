@extends('layouts.admin')

@section('title', 'Manage Messages')
@section('page-title', 'Contact Inquiries')
@section('page-subtitle', 'Messages submitted by clients and recruiters from the portfolio contact form.')

@section('content')
<div class="admin-card">
    @if($messages->isEmpty())
        <div class="empty-state">
            <p>No contact messages yet.</p>
        </div>
    @else
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                        <tr style="{{ !$msg->is_read ? 'background: rgba(139, 92, 246, 0.05); font-weight: 500;' : '' }}">
                            <td>
                                <span class="badge {{ $msg->is_read ? 'badge-success' : 'badge-danger' }}">
                                    {{ $msg->is_read ? 'Read' : 'New' }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ $msg->name }}</strong>
                                <div style="font-size: 11px; color: var(--text-muted);">{{ $msg->email }}</div>
                            </td>
                            <td>
                                {{ Str::limit($msg->subject ?? 'No subject', 40) }}
                            </td>
                            <td style="font-size: var(--font-xs); color: var(--text-muted); white-space: nowrap;">
                                {{ $msg->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-secondary btn-sm" title="Read message">
                                    Read
                                </a>
                                @if(!$msg->is_read)
                                    <form action="{{ route('admin.messages.read', $msg) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-secondary btn-sm" title="Mark as read">
                                            ✓
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" data-confirm="Delete this message?" title="Delete">
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
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection
