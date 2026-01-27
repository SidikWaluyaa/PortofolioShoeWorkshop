<?php

namespace App\Services;

use App\Models\AboutSection;

class AboutService
{
    public function getActive()
    {
        return AboutSection::where('is_active', true)->first();
    }

    public function getAll()
    {
        return AboutSection::all();
    }

    public function create(array $data)
    {
        return AboutSection::create($data);
    }

    public function update(AboutSection $about, array $data)
    {
        $about->update($data);
        return $about;
    }

    public function delete(AboutSection $about)
    {
        return $about->delete();
    }
}
