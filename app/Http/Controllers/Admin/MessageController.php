<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages     = Message::latest()->paginate(15);
        $unreadCount  = Message::unread()->count();

        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    public function show(Message $message)
    {
        $message->markAsRead();

        return view('admin.messages.show', compact('message'));
    }

    public function markRead(Message $message)
    {
        $message->markAsRead();

        return redirect()->back()->with('success', 'Message marked as read.');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
