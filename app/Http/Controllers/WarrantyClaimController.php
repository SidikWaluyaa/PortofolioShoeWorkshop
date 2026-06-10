<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class WarrantyClaimController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        
        // Base URL of the backend workshop system (e.g. http://info.shoeworkshop.id)
        $backendUrl = $settings['tracking_base_url'] ?? 'http://info.shoeworkshop.id';
        
        // Final API URL for warranty claims endpoint
        $apiUrl = rtrim($backendUrl, '/') . '/api/v1/public/warranty-claims';

        return view('warranty_claim', compact('settings', 'apiUrl'));
    }
}
