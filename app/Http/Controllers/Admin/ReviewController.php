<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(protected ReviewService $reviewService) {}

    public function index()
    {
        return view('admin.reviews.index', [
            'reviews' => $this->reviewService->getAll()
        ]);
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'location'  => 'nullable|string|max:255',
            'rating'    => 'required|integer|min:1|max:5',
            'content'   => 'required|string',
            'is_active' => 'nullable|boolean',
            'order'     => 'nullable|integer',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['order'] = $data['order'] ?? 0;

        $this->reviewService->create($data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review berhasil ditambahkan.');
    }

    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'location'  => 'nullable|string|max:255',
            'rating'    => 'required|integer|min:1|max:5',
            'content'   => 'required|string',
            'is_active' => 'nullable|boolean',
            'order'     => 'nullable|integer',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['order'] = $data['order'] ?? 0;

        $this->reviewService->update($review, $data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review berhasil diupdate.');
    }

    public function destroy(Review $review)
    {
        $this->reviewService->delete($review);
        return redirect()->route('admin.reviews.index')->with('success', 'Review berhasil dihapus.');
    }
}