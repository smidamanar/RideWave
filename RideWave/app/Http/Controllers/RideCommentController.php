<?php

namespace App\Http\Controllers;

use App\Models\RideComment;
use App\Models\Trajet;
use App\Notifications\RideCommentNotification;
use Illuminate\Http\Request;

class RideCommentController extends Controller
{
    public function store(Request $request, Trajet $trajet)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:ride_comments,id',
        ]);

        $parent = null;

        if ($request->filled('parent_id')) {
            $parent = RideComment::query()
                ->where('trajet_id', $trajet->id)
                ->findOrFail($request->integer('parent_id'));
        }

        $comment = RideComment::create([
            'trajet_id' => $trajet->id,
            'user_id' => $request->user()->id,
            'parent_id' => $parent?->id,
            'body' => $request->string('body')->trim(),
        ]);

        $comment->load(['user', 'trajet', 'parent.user']);

        $recipient = null;

        if ($request->user()->id === $trajet->conducteur_id && $parent && $parent->user_id !== $request->user()->id) {
            $recipient = $parent->user;
        }

        if ($request->user()->id !== $trajet->conducteur_id) {
            $recipient = $trajet->conducteur;
        }

        if ($recipient && $recipient->id !== $request->user()->id) {
            $recipient->notify(new RideCommentNotification($comment));
        }

        return back()->with('success', 'Comment posted successfully.');
    }
}
