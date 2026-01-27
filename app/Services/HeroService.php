<?php

namespace App\Services;

use App\Models\HeroSection;

class HeroService
{
    public function getActive()
    {
        return HeroSection::where('is_active', true)->first();
    }

    public function getAll()
    {
        return HeroSection::all();
    }

    public function create(array $data)
    {
        return HeroSection::create($data);
    }

    public function update(HeroSection $hero, array $data)
    {
        $hero->update($data);
        return $hero;
    }

    public function delete(HeroSection $hero)
    {
        return $hero->delete();
    }
}
