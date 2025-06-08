<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Order;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::with('order')->orderBy('created_at', 'desc')->get();
        return view('feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for automatically created new resource.
     */
    public function show($id)
    {
        $feedback = Feedback::with('order')->findOrFail($id);
        return view('feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $feedback = Feedback::with('order')->findOrFail($id);
        return view('feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $feedback = Feedback::findOrFail($id); 
        $feedback->update([
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('feedback')->with('success', 'Feedback berhasil diperbarui :)');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        $feedback->delete();

        return redirect()->route('feedback')->with('success', 'Feedback berhasil dihapus :)');
    }
}
