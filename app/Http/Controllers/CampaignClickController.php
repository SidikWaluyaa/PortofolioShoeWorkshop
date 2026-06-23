<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignClickController extends Controller
{
    /**
     * Increment the click count telemetry and redirect to target URL.
     */
    public function trackClick(Campaign $campaign)
    {
        // Safe increment using raw database operation to prevent race condition issues
        $campaign->increment('clicks_count');

        $targetUrl = $campaign->target_url;

        if (empty($targetUrl)) {
            return redirect()->to(route('home'));
        }

        return redirect()->away($targetUrl);
    }
}
