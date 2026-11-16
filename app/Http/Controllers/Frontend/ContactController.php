<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        Message::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'subject'    => $request->subject,
            'body'       => $request->message,
            'ip_address' => $request->ip(),
        ]);

        return redirect()
            ->route('home', '#contact')
            ->with('contact_success', 'Thank you! Your message has been sent successfully.');
    }
}
