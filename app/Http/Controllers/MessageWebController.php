<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageWebController extends Controller
{
    public function index()
    {
        // For now, return empty messages. In a real app, you'd have a Message model
        $messages = collect(); // Placeholder
        return view('messages.index', compact('messages'));
    }

    public function show($id)
    {
        // Placeholder
        return view('messages.show');
    }

    public function create()
    {
        return view('messages.create');
    }

    public function store(Request $request)
    {
        // Placeholder for sending message
        return redirect()->route('messages.index')->with('success', 'Message envoyé.');
    }
}