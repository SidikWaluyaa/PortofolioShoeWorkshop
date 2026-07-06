<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananCategory;
use App\Models\LayananService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananServiceController extends Controller
{
    public function index(LayananCategory $layanan_category)
    {
        $services = $layanan_category->services()->orderBy('created_at', 'desc')->get();
        return view('admin.layanan_services.index', compact('layanan_category', 'services'));
    }

    public function create(LayananCategory $layanan_category)
    {
        return view('admin.layanan_services.create', compact('layanan_category'));
    }

    public function store(Request $request, LayananCategory $layanan_category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subtitle_teknis' => 'nullable|string|max:255',
            'proses' => 'nullable|string',
            'kapan' => 'nullable|string',
            'kenapa_penting' => 'nullable|string',
            'is_preview' => 'boolean',
            'image_before' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_after' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['image_before', 'image_after']);
        $data['is_preview'] = $request->has('is_preview');

        if ($request->hasFile('image_before')) {
            $data['image_before'] = 'storage/' . \App\Helpers\ImageCompressionHelper::compressAndStore($request->file('image_before'), 'layanan', null, true);
        }
        if ($request->hasFile('image_after')) {
            $data['image_after'] = 'storage/' . \App\Helpers\ImageCompressionHelper::compressAndStore($request->file('image_after'), 'layanan', null, true);
        }

        $layanan_category->services()->create($data);

        return redirect()->route('admin.layanan-categories.services.index', $layanan_category->id)
            ->with('success', 'Sub-Jasa berhasil ditambahkan.');
    }

    public function edit(LayananCategory $layanan_category, LayananService $service)
    {
        return view('admin.layanan_services.edit', compact('layanan_category', 'service'));
    }

    public function update(Request $request, LayananCategory $layanan_category, LayananService $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subtitle_teknis' => 'nullable|string|max:255',
            'proses' => 'nullable|string',
            'kapan' => 'nullable|string',
            'kenapa_penting' => 'nullable|string',
            'is_preview' => 'boolean',
            'image_before' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_after' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['image_before', 'image_after']);
        $data['is_preview'] = $request->has('is_preview');

        if ($request->hasFile('image_before')) {
            if ($service->image_before && str_starts_with($service->image_before, 'storage/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $service->image_before));
            }
            $data['image_before'] = 'storage/' . \App\Helpers\ImageCompressionHelper::compressAndStore($request->file('image_before'), 'layanan', null, true);
        }

        if ($request->hasFile('image_after')) {
            if ($service->image_after && str_starts_with($service->image_after, 'storage/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $service->image_after));
            }
            $data['image_after'] = 'storage/' . \App\Helpers\ImageCompressionHelper::compressAndStore($request->file('image_after'), 'layanan', null, true);
        }

        $service->update($data);

        return redirect()->route('admin.layanan-categories.services.index', $layanan_category->id)
            ->with('success', 'Sub-Jasa berhasil diperbarui.');
    }

    public function destroy(LayananCategory $layanan_category, LayananService $service)
    {
        if ($service->image_before && str_starts_with($service->image_before, 'storage/')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $service->image_before));
        }
        if ($service->image_after && str_starts_with($service->image_after, 'storage/')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $service->image_after));
        }
        
        $service->delete();

        return redirect()->route('admin.layanan-categories.services.index', $layanan_category->id)
            ->with('success', 'Sub-Jasa berhasil dihapus.');
    }
}
