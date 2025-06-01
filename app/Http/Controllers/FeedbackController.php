<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::with('user')->latest()->get();
        return view('feedback.index', compact('feedbacks'));
        //
    }

    /**
        * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feedback.create');
        //
    }

    /**
        * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route(feedback.index)->with('success', 'Feedback berhasil disubmit :D.');
        //
    }

    /**
        * Display the specified resource.
     */
    public function show(string $id)
    {
        $feedback = Feedback::with('user')->findOrFail($id);
        return view('feedback.show', compact('feedback'));
        //
    }

    /**
        * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feedback = Feedback::findOrFail($id);

        if ($feedback->user_id !== auth()->id()) {
            return redirect()->route('feedback.index')->with('error', 'Anda tidak memiliki akses ke feedback tersebut :(.');
        }

        return view('feedback.edit', compact('feedback'));
        //
    }

    /**
        * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fedback = Feedback::findOrFail($id);
        if ($fedback->user_id !== auth()->id()) {
            return redirect()->route('feedback.index')->with('error', 'Anda tidak memiliki akses ke feedback tersebut :(.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $fedback->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil diperbarui :D.');
        //
    }

    /**
        * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedback = Feedback::findOrFail($id);
        if ($feedback->user_id !== auth()->id()) {
            return redirect()->route('feedback.index')->with('error', 'Anda tidak memiliki akses ke feedback tersebut :(.');
        }

        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus :D.');
        //
    }
}