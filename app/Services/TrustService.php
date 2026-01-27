<?php

namespace App\Services;

use App\Models\TrustItem;

class TrustService
{
    public function getActive()
    {
        return TrustItem::where('is_active', true)->orderBy('order')->get();
    }

    public function getAll()
    {
        return TrustItem::orderBy('order')->get();
    }

    public function create(array $data)
    {
        return TrustItem::create($data);
    }

    public function update(TrustItem $trustItem, array $data)
    {
        $trustItem->update($data);
        return $trustItem;
    }

    public function delete(TrustItem $trustItem)
    {
        return $trustItem->delete();
    }
}
