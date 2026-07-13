<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Services\HeroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageCompressionHelper;

class HeroController extends Controller
{
    public function __construct(protected HeroService $heroService) {}

    public function index()
    {
        $heroes = $this->heroService->getAll();
        return view('admin.hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'primary_cta_text' => 'nullable|string|max:50',
            'primary_cta_link' => 'nullable|string',
            'secondary_cta_text' => 'nullable|string|max:50',
            'secondary_cta_link' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = ImageCompressionHelper::compressAndStore($request->file('image'), 'hero', null, false, 1920, 1080);
        }

        $this->heroService->create($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero section created successfully.');
    }

    public function edit(HeroSection $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, HeroSection $hero)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'primary_cta_text' => 'nullable|string|max:50',
            'primary_cta_link' => 'nullable|string',
            'secondary_cta_text' => 'nullable|string|max:50',
            'secondary_cta_link' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = ImageCompressionHelper::compressAndStore($request->file('image'), 'hero', null, false, 1920, 1080);
        }

        $this->heroService->update($hero, $data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero section updated successfully.');
    }

    public function destroy(HeroSection $hero)
    {
        if ($hero->image) {
            Storage::disk('public')->delete($hero->image);
        }
        $this->heroService->delete($hero);
        return redirect()->route('admin.hero.index')->with('success', 'Hero section deleted successfully.');
    }
}
