<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Katalog Barang Donasi</title>
    <style>
        @page {
            margin: 1.2cm 1.5cm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            font-size: 10px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .header-container {
            width: 100%;
            border-bottom: 2px solid #22AF85;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
            margin: 0 0 4px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .subtitle {
            font-size: 11px;
            color: #64748b;
            margin: 0;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .meta-cell {
            vertical-align: top;
            width: 50%;
        }
        .meta-label {
            font-weight: bold;
            color: #475569;
            margin-bottom: 2px;
            text-transform: uppercase;
            font-size: 8px;
            letter-spacing: 0.5px;
        }
        .meta-value {
            color: #0f172a;
            font-size: 10px;
        }
        .summary-container {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 20px;
        }
        .summary-title {
            font-size: 10px;
            font-weight: bold;
            color: #334155;
            margin: 0 0 6px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .summary-table {
            width: 100%;
        }
        .summary-cell {
            width: 25%;
            font-size: 10px;
        }
        .summary-number {
            font-size: 16px;
            font-weight: bold;
            color: #22AF85;
        }
        .summary-label {
            color: #64748b;
            font-size: 9px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th {
            background-color: #22AF85;
            color: #ffffff;
            font-weight: bold;
            text-align: left;
            text-transform: uppercase;
            font-size: 8px;
            letter-spacing: 0.5px;
            padding: 8px 10px;
            border: 1px solid #22AF85;
        }
        .data-table td {
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .badge {
            display: inline-block;
            padding: 3px 6px;
            font-size: 8px;
            font-weight: bold;
            border-radius: 4px;
            text-align: center;
        }
        .badge-sepatu {
            background-color: #e0e7ff;
            color: #4338ca;
        }
        .badge-tas {
            background-color: #f3e8ff;
            color: #6b21a8;
        }
        .badge-topi {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-tersedia {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-disalurkan {
            background-color: #f1f5f9;
            color: #475569;
        }
        .badge-kondisi {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
        }
        .text-bold {
            font-weight: bold;
        }
        .text-gray {
            color: #64748b;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            text-align: center;
            color: #94a3b8;
            font-size: 8px;
            border-top: 1px solid #e2e8f0;
            padding-top: 5px;
        }
        .page-number:before {
            content: counter(page);
        }
        .services-list {
            margin: 0;
            padding-left: 12px;
            color: #475569;
            font-size: 9px;
        }
        .img-thumbnail {
            width: 90px;
            height: auto;
            max-height: 90px;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="header-container">
        <table style="width: 100%;">
            <tr>
                <td style="vertical-align: middle;">
                    <h1 class="title">Katalog Barang Donasi</h1>
                    <p class="subtitle">Shoe Workshop - Laporan inventarisasi barang donasi siap salur</p>
                </td>
                <td style="text-align: right; vertical-align: middle;">
                    <span style="font-size: 14px; font-weight: bold; color: #22AF85;">SHOE WORKSHOP</span>
                </td>
            </tr>
        </table>
    </div>

    <table class="meta-table">
        <tr>
            <td class="meta-cell">
                <div class="meta-label">Tanggal Cetak</div>
                <div class="meta-value">{{ now()->translatedFormat('d F Y H:i') }}</div>
            </td>
            <td class="meta-cell">
                <div class="meta-label">Filter Diterapkan</div>
                <div class="meta-value">
                    @php
                        $appliedFilters = [];
                        if (!empty($filters['search'])) $appliedFilters[] = 'Cari: "' . $filters['search'] . '"';
                        if (!empty($filters['brand'])) $appliedFilters[] = 'Brand: ' . $filters['brand'];
                        if (!empty($filters['kategori'])) $appliedFilters[] = 'Kategori: ' . ucfirst($filters['kategori']);
                        if (!empty($filters['status'])) $appliedFilters[] = 'Status: ' . ($filters['status'] === 'tersedia' ? 'Tersedia' : 'Disalurkan');
                        if (!empty($filters['sort'])) $appliedFilters[] = 'Urutan: ' . ($filters['sort'] === 'asc' ? 'Terlama (ASC)' : 'Terbaru (DESC)');
                    @endphp
                    {{ empty($appliedFilters) ? 'Semua Data (Tanpa Filter)' : implode(', ', $appliedFilters) }}
                </div>
            </td>
        </tr>
    </table>

    <div class="summary-container">
        <h3 class="summary-title">Ringkasan Laporan</h3>
        <table class="summary-table">
            <tr>
                <td class="summary-cell">
                    <div class="summary-number">{{ $items->count() }}</div>
                    <div class="summary-label">Total Barang</div>
                </td>
                <td class="summary-cell">
                    <div class="summary-number" style="color: #4338ca;">{{ $items->where('kategori', 'sepatu')->count() }}</div>
                    <div class="summary-label">Sepatu</div>
                </td>
                <td class="summary-cell">
                    <div class="summary-number" style="color: #6b21a8;">{{ $items->where('kategori', 'tas')->count() }}</div>
                    <div class="summary-label">Tas</div>
                </td>
                <td class="summary-cell">
                    <div class="summary-number" style="color: #92400e;">{{ $items->where('kategori', 'topi')->count() }}</div>
                    <div class="summary-label">Topi</div>
                </td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 13%;">Foto</th>
                <th style="width: 8%;">Kode</th>
                <th style="width: 15%;">Nama Barang</th>
                <th style="width: 8%;">Brand</th>
                <th style="width: 8%;">Kategori</th>
                <th style="width: 8%;">Kondisi</th>
                <th style="width: 5%;">Ukuran</th>
                <th style="width: 5%;">Berat</th>
                <th style="width: 5%;">Kelayakan</th>
                <th style="width: 14%;">Jasa Reparasi</th>
                <th style="width: 8%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
                @php
                    $imageSrc = null;
                    if (!empty($item->foto_utama_path)) {
                        if (Str::startsWith($item->foto_utama_path, 'images/') || Str::startsWith($item->foto_utama_path, 'storage/')) {
                            $filePath = public_path($item->foto_utama_path);
                        } else {
                            $filePath = storage_path('app/public/' . $item->foto_utama_path);
                        }
                        
                        if (file_exists($filePath)) {
                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                            $imageSrc = 'data:image/' . $extension . ';base64,' . base64_encode(file_get_contents($filePath));
                        }
                    }
                @endphp
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        @if($imageSrc)
                            <img src="{{ $imageSrc }}" class="img-thumbnail" alt="Foto">
                        @else
                            <span class="text-gray" style="font-size: 8px; font-style: italic;">No Photo</span>
                        @endif
                    </td>
                    <td style="font-family: monospace; font-weight: bold; color: #475569; vertical-align: middle;">{{ $item->kode_barang ?? '-' }}</td>
                    <td class="text-bold" style="vertical-align: middle;">
                        {{ $item->nama }}
                        @if($item->deskripsi)
                            <div class="text-gray" style="font-weight: normal; font-size: 8px; margin-top: 3px;">
                                {{ Str::limit($item->deskripsi, 60) }}
                            </div>
                        @endif
                    </td>
                    <td style="vertical-align: middle;">{{ $item->brand ?? '-' }}</td>
                    <td style="vertical-align: middle;">
                        <span class="badge badge-{{ $item->kategori }}">
                            {{ $item->kategori === 'sepatu' ? '👞 Sepatu' : ($item->kategori === 'tas' ? '🎒 Tas' : '🧢 Topi') }}
                        </span>
                    </td>
                    <td style="vertical-align: middle;">
                        <span class="badge badge-kondisi">
                            {{ str_replace('_', ' ', ucfirst($item->kondisi)) }}
                        </span>
                    </td>
                    <td style="vertical-align: middle;">{{ $item->ukuran ?? '-' }}</td>
                    <td style="vertical-align: middle;">{{ $item->berat_formatted }}</td>
                    <td class="text-bold" style="color: {{ $item->score_kelayakan >= 90 ? '#065f46' : ($item->score_kelayakan >= 70 ? '#0f766e' : ($item->score_kelayakan >= 50 ? '#b45309' : '#b91c1c')) }}; vertical-align: middle;">
                        {{ $item->score_kelayakan ? $item->score_kelayakan . '%' : '-' }}
                    </td>
                    <td style="vertical-align: middle;">
                        @if($item->reparationServices->isNotEmpty())
                            <ul class="services-list">
                                @foreach($item->reparationServices as $rs)
                                    <li>{{ $rs->jasa_nama }} ({{ $rs->jasa_harga_formatted }})</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray">-</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle;">
                        <span class="badge badge-{{ $item->status }}">
                            {{ $item->status === 'tersedia' ? 'Tersedia' : 'Disalurkan' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" style="text-align: center; color: #64748b; padding: 20px;">
                        Tidak ada data barang donasi ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Halaman <span class="page-number"></span> | Laporan Katalog Barang Donasi Shoe Workshop
    </div>

</body>
</html>
