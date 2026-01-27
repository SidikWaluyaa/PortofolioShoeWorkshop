<?php

namespace App\Services;

use App\Models\CtaSection;

class CtaService
{
    public function getActive()
    {
        return CtaSection::where('is_active', true)->first();
    }

    public function getAll()
    {
        return CtaSection::all();
    }

    public function create(array $data)
    {
        return CtaSection::create($data);
    }

    public function update(CtaSection $cta, array $data)
    {
        $cta->update($data);
        return $cta;
    }

    public function delete(CtaSection $cta)
    {
        return $cta->delete();
    }
}
