<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CtaSection;
use App\Services\CtaService;
use Illuminate\Http\Request;

class CtaController extends Controller
{
    public function __construct(protected CtaService $ctaService) {}

    public function index()
    {
        $ctas = $this->ctaService->getAll();
        return view('admin.cta.index', compact('ctas'));
    }

    public function create()
    {
        return view('admin.cta.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $this->ctaService->create($data);

        return redirect()->route('admin.cta.index')->with('success', 'CTA section created successfully.');
    }

    public function edit(CtaSection $cta)
    {
        return view('admin.cta.edit', compact('cta'));
    }

    public function update(Request $request, CtaSection $cta)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $this->ctaService->update($cta, $data);

        return redirect()->route('admin.cta.index')->with('success', 'CTA section updated successfully.');
    }

    public function destroy(CtaSection $cta)
    {
        $this->ctaService->delete($cta);
        return redirect()->route('admin.cta.index')->with('success', 'CTA section deleted successfully.');
    }
}
