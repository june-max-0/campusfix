<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        $query = ServiceRequest::query();

        // Normal users only count their own requests
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $counts = [
            'total'       => (clone $query)->count(),
            'pending'     => (clone $query)->where('status', 'pending')->count(),
            'in_progress' => (clone $query)->where('status', 'in_progress')->count(),
            'completed'   => (clone $query)->where('status', 'completed')->count(),
        ];

        $recent = (clone $query)->with('category')->latest()->take(5)->get();

        return view('dashboard', compact('counts', 'recent'));
    }
}