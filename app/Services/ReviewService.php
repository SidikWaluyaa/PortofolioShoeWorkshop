<?php

namespace App\Services;

use App\Models\Review;

class ReviewService
{
    public function getActive()
    {
        return Review::where('is_active', true)->orderBy('order')->get();
    }

    public function getAll()
    {
        return Review::orderBy('order')->get();
    }

    public function create(array $data)
    {
        return Review::create($data);
    }

    public function update(Review $review, array $data)
    {
        $review->update($data);
        return $review;
    }

    public function delete(Review $review)
    {
        $review->delete();
    }
}