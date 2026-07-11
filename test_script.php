<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$rewards = \App\Models\Reward::all();
echo "ALL REWARDS:\n";
foreach($rewards as $r) {
    echo "ID: {$r->id} | Kategori: {$r->kategori_reward} | Stok: {$r->stok} | Aktif: {$r->status_aktif}\n";
}

$donasiCount = \App\Models\Donation::whereIn('status', ['diterima', 'siap_rilis', 'disalurkan'])
    ->where('is_reward_claimed', false)
    ->count();
echo "\nUnclaimed Donation Count: {$donasiCount}\n";
