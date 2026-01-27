<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustItem;
use App\Services\TrustService;
use Illuminate\Http\Request;

class TrustController extends Controller
{
    public function __construct(protected TrustService $trustService) {}

    public function index()
    {
        $items = $this->trustService->getAll();
        return view('admin.trust.index', compact('items'));
    }

    public function create()
    {
        return view('admin.trust.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $this->trustService->create($data);

        return redirect()->route('admin.trust.index')->with('success', 'Trust item created successfully.');
    }

    public function edit(TrustItem $trust)
    {
        return view('admin.trust.edit', compact('trust'));
    }

    public function update(Request $request, TrustItem $trust)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $this->trustService->update($trust, $data);

        return redirect()->route('admin.trust.index')->with('success', 'Trust item updated successfully.');
    }

    public function destroy(TrustItem $trust)
    {
        $this->trustService->delete($trust);
        return redirect()->route('admin.trust.index')->with('success', 'Trust item deleted successfully.');
    }
}
