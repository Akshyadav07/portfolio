@extends('layouts.admin')

@section('title', 'Message: ' . $message->name)
@section('page-title', 'Read Message')
@section('page-subtitle', 'Contact submission details.')

@section('page-actions')
    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">
        &larr; Back to Messages
    </a>
@endsection

@section('content')
<div class="admin-card" style="max-width: 800px;">
    <div style="display:flex; justify-content:space-between; align-items:center; border-bottom: 1px solid var(--border); padding-bottom: 1.25rem; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2 style="font-size: var(--font-xl); color: var(--text-primary); margin-bottom: 0.25rem;">
                {{ $message->subject ?: '(No Subject)' }}
            </h2>
            <div style="color: var(--text-secondary); font-size: var(--font-sm);">
                From: <strong style="color: var(--text-primary);">{{ $message->name }}</strong>
                &lt;<a href="mailto:{{ $message->email }}" style="color: var(--accent);">{{ $message->email }}</a>&gt;
            </div>
        </div>
        <div style="font-size: var(--font-xs); color: var(--text-muted); text-align: right;">
            <div>Received: {{ $message->created_at->format('M d, Y - h:i A') }}</div>
            @if($message->ip_address)
                <div>IP: {{ $message->ip_address }}</div>
            @endif
        </div>
    </div>

    <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 1.5rem; min-height: 200px; color: var(--text-primary); line-height: 1.8; font-size: 1.05rem; white-space: pre-wrap;">{{ $message->body }}</div>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-top: 2rem;">
        <a href="mailto:{{ $message->email }}?subject={{ urlencode('Re: ' . ($message->subject ?: 'Inquiry')) }}" class="btn btn-primary">
            Reply via Email &rarr;
        </a>

        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" data-confirm="Are you sure you want to delete this message?">
                Delete Message
            </button>
        </form>
    </div>
</div>
@endsection
