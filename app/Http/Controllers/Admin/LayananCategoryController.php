<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananCategoryController extends Controller
{
    public function index()
    {
        $categories = LayananCategory::withCount('services')->orderBy('order')->get();
        return view('admin.layanan_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.layanan_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'value_material' => 'nullable|string',
            'value_kehidupan' => 'nullable|string',
            'cta' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);

        LayananCategory::create($data);

        return redirect()->route('admin.layanan-categories.index')->with('success', 'Kategori Layanan berhasil ditambahkan.');
    }

    public function edit(LayananCategory $layanan_category)
    {
        return view('admin.layanan_categories.edit', compact('layanan_category'));
    }

    public function update(Request $request, LayananCategory $layanan_category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'value_material' => 'nullable|string',
            'value_kehidupan' => 'nullable|string',
            'cta' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);

        $layanan_category->update($data);

        return redirect()->route('admin.layanan-categories.index')->with('success', 'Kategori Layanan berhasil diperbarui.');
    }

    public function destroy(LayananCategory $layanan_category)
    {
        $layanan_category->delete();
        return redirect()->route('admin.layanan-categories.index')->with('success', 'Kategori Layanan berhasil dihapus.');
    }
}
