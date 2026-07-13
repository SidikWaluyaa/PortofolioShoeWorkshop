<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Services\AboutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageCompressionHelper;

class AboutController extends Controller
{
    public function __construct(protected AboutService $aboutService) {}

    public function index()
    {
        $sections = $this->aboutService->getAll();
        return view('admin.about.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = ImageCompressionHelper::compressAndStore($request->file('image'), 'about', null, false, 1200, 800);
        }

        $this->aboutService->create($data);

        return redirect()->route('admin.about.index')->with('success', 'About section created successfully.');
    }

    public function edit(AboutSection $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, AboutSection $about)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $data['image'] = ImageCompressionHelper::compressAndStore($request->file('image'), 'about', null, false, 1200, 800);
        }

        $this->aboutService->update($about, $data);

        return redirect()->route('admin.about.index')->with('success', 'About section updated successfully.');
    }

    public function destroy(AboutSection $about)
    {
        if ($about->image) {
            Storage::disk('public')->delete($about->image);
        }
        $this->aboutService->delete($about);
        return redirect()->route('admin.about.index')->with('success', 'About section deleted successfully.');
    }
}
