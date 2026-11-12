<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Show the feedback form
    public function create()
    {
        return view('feedback.create');
    }

    // Save the feedback
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'rating'  => 'required|integer|between:1,5',
        ]);

        $validated['user_id'] = auth()->id();
        Feedback::create($validated);

        return redirect()->route('feedback.create')
            ->with('success', 'Thank you! Your feedback has been sent.');
    }

    // Admin only: list all feedback
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $feedbacks = Feedback::with('user')->latest()->paginate(10);

        return view('feedback.index', compact('feedbacks'));
    }
}