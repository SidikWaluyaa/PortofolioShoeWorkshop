<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageCompressionHelper;

class CampaignController extends Controller
{
    /**
     * Display a listing of campaigns.
     */
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new campaign.
     */
    public function create()
    {
        return view('admin.campaigns.create');
    }

    /**
     * Store a newly created campaign in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'type' => 'required|in:image_upload,image_url,text_only',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'image_url' => 'nullable|url',
            'promo_text' => 'nullable|string',
            'cta_text' => 'nullable|string|max:100',
            'target_url' => 'nullable|url',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image') && $request->type === 'image_upload') {
            $data['image_path'] = ImageCompressionHelper::compressAndStore($request->file('image'), 'campaigns', null, false, 1200, 800);
        }

        Campaign::create($data);

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified campaign.
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified campaign in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'type' => 'required|in:image_upload,image_url,text_only',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'image_url' => 'nullable|url',
            'promo_text' => 'nullable|string',
            'cta_text' => 'nullable|string|max:100',
            'target_url' => 'nullable|url',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image') && $request->type === 'image_upload') {
            if ($campaign->image_path) {
                Storage::disk('public')->delete($campaign->image_path);
            }
            $data['image_path'] = ImageCompressionHelper::compressAndStore($request->file('image'), 'campaigns', null, false, 1200, 800);
        }

        $campaign->update($data);

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil diperbarui.');
    }

    /**
     * Remove the specified campaign from storage.
     */
    public function destroy(Campaign $campaign)
    {
        if ($campaign->image_path) {
            Storage::disk('public')->delete($campaign->image_path);
        }
        $campaign->delete();

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil dihapus.');
    }
}
