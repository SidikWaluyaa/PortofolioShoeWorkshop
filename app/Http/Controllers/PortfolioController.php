<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function index()
    {
        $settings   = Setting::pluck('value', 'key')->toArray();
        $folder     = public_path('images/portfolio');
        $categories = [];

        if (File::exists($folder)) {
            $files = File::files($folder);

            foreach ($files as $file) {
                $name = $file->getFilenameWithoutExtension();

                // Match format: CategoryName_Before or CategoryName_After
                if (preg_match('/^(.+)_(Before|After)$/i', $name, $matches)) {
                    $category = $matches[1];
                    $type     = strtolower($matches[2]);
                    $categories[$category][$type] = $file->getFilename();
                }
            }

            // Only show categories that have both before AND after
            $categories = array_filter($categories, function ($imgs) {
                return isset($imgs['before']) && isset($imgs['after']);
            });

            ksort($categories);
        }

        return view('portfolio', compact('settings', 'categories'));
    }
}