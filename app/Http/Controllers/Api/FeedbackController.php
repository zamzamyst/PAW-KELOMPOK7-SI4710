<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;


class FeedbackController extends Controller
{

    // Fungsi untuk Menampilkan Data Feedback (All) via API
    public function index()
    {
        $feedback = Feedback::latest()->get();

        if ($feedback->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Data Feedback tidak tersedia!',
            ], 404);

        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Feedback berhasil ditemukan!',
                'data' => $feedback
            ], 200);
        }
    }

    // Fungsi untuk Menampilkan Data Feedback (By ID) via API
    public function show($id)
    {
        $feedback = feedback::find($id);
        
        if ($feedback) {
            return response()->json([
                'status' => true,
                'message' => 'Data Feedback (ID: ' . $feedback->id . ') berhasil ditemukan!',
                'data' => $feedback
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data Feedback (ID: ' . $id . ') tidak ditemukan!',
            ], 404);
        }
    }
}
