<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    // READ + SEARCH: list requests
    public function index(Request $request)
    {
        $query = ServiceRequest::with(['user', 'category'])->latest();

        // Normal users only see their own requests
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        // Search by title, description or location
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->paginate(10)->withQueryString();

        return view('requests.index', compact('requests'));
    }

    // CREATE: show the form
    public function create()
    {
        $categories = Category::all();
        return view('requests.create', compact('categories'));
    }

    // CREATE: save to database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'priority'    => 'required|in:low,medium,high',
        ]);

        $validated['user_id'] = auth()->id();
        ServiceRequest::create($validated);

        return redirect()->route('requests.index')
            ->with('success', 'Request submitted successfully.');
    }

    // UPDATE: show the edit form
    public function edit(ServiceRequest $serviceRequest)
    {
        $this->checkAccess($serviceRequest);
        $categories = Category::all();
        return view('requests.edit', compact('serviceRequest', 'categories'));
    }

    // UPDATE: save changes
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $this->checkAccess($serviceRequest);

        $rules = [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'priority'    => 'required|in:low,medium,high',
        ];

        // Only admin can change the status
        if (auth()->user()->role === 'admin') {
            $rules['status'] = 'required|in:pending,in_progress,completed';
        }

        $serviceRequest->update($request->validate($rules));

        return redirect()->route('requests.index')
            ->with('success', 'Request updated successfully.');
    }

    // DELETE
    public function destroy(ServiceRequest $serviceRequest)
    {
        $this->checkAccess($serviceRequest);
        $serviceRequest->delete();

        return redirect()->route('requests.index')
            ->with('success', 'Request deleted.');
    }

    // Admin can touch everything, users only their own
    private function checkAccess(ServiceRequest $serviceRequest)
    {
        if (auth()->user()->role !== 'admin' && $serviceRequest->user_id !== auth()->id()) {
            abort(403);
        }
    }
}