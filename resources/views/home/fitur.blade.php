@php
    $user = auth()->user();
    $featureList = [];

    if ($user && $user->isAdmin()) {
        $featureList = [
            ['title' => 'Kelola User', 'icon' => 'fas fa-users', 'color' => '#1f73d8', 'url' => route('user.index')],
            ['title' => 'Log Aktivitas', 'icon' => 'fas fa-history', 'color' => '#17a2b8', 'url' => route('log.aktivitas')],
            ['title' => 'Kelola Kategori', 'icon' => 'fas fa-tags', 'color' => '#fd7e14', 'url' => route('kategori.index')],
            ['title' => 'Kelola Alat', 'icon' => 'fas fa-toolbox', 'color' => '#20c997', 'url' => route('alat.index')],
            ['title' => 'Kelola Peminjaman', 'icon' => 'fas fa-handshake', 'color' => '#0d6efd', 'url' => route('peminjaman.index')],
            ['title' => 'Menetujui Peminjaman', 'icon' => 'fas fa-check-circle', 'color' => '#28a745', 'url' => route('approval.index')],
            ['title' => 'Memantau Pengembalian', 'icon' => 'fas fa-clipboard-check', 'color' => '#f4b400', 'url' => route('return-monitoring.index')],
            ['title' => 'Mencetak Laporan', 'icon' => 'fas fa-print', 'color' => '#17a2b8', 'url' => route('laporan')],
        ];
    } elseif ($user && $user->isPetugas()) {
        $featureList = [
            ['title' => 'Menetujui Peminjaman', 'icon' => 'fas fa-check-circle', 'color' => '#28a745', 'url' => route('approval.index')],
            ['title' => 'Memantau Pengembalian', 'icon' => 'fas fa-clipboard-check', 'color' => '#f4b400', 'url' => route('return-monitoring.index')],
            ['title' => 'Mencetak Laporan', 'icon' => 'fas fa-print', 'color' => '#17a2b8', 'url' => route('laporan')],
        ];
    } elseif ($user && $user->isPeminjam()) {
        $featureList = [
            ['title' => 'Melihat daftar alat', 'icon' => 'fas fa-list', 'color' => '#17a2b8', 'url' => route('alat.daftar')],
            ['title' => 'Mengajukan peminjaman', 'icon' => 'fas fa-hand-holding', 'color' => '#28a745', 'url' => route('peminjaman.ajukan')],
            ['title' => 'Mengembalikan alat', 'icon' => 'fas fa-undo-alt', 'color' => '#f4b400', 'url' => route('return-monitoring.saya')],
        ];
    }
@endphp

@if (!empty($featureList))
<div class="card mt-4" style="border: 1px solid #d9d9d9; border-radius: 0; overflow: hidden; box-shadow: none;">
    <div class="card-header" style="background: #fff; border-bottom: 1px solid #d9d9d9; padding: 14px 18px;">
        <h3 class="card-title mb-0" style="font-size: 18px; font-weight: 600; color: #2f2f2f;">
            <i class="fas fa-cubes mr-2" style="color: #1f73d8;"></i>Fitur Utama Sistem
        </h3>
    </div>

    <div class="card-body p-0" style="background: #fff;">
        <div class="row no-gutters">
            <div class="col-md-6" style="border-right: 1px solid #d9d9d9;">
                <ul class="list-group list-group-flush mb-0">
                    @foreach (array_slice($featureList, 0, ceil(count($featureList) / 2)) as $feature)
                        <li class="list-group-item border-0 py-3 px-4" style="border-bottom: 1px solid #e5e5e5 !important; min-height: 62px;">
                            <a href="{{ $feature['url'] }}" class="text-dark text-decoration-none d-flex align-items-center h-100" style="font-size: 16px; font-weight: 500;">
                                <i class="{{ $feature['icon'] }} mr-3" style="color: {{ $feature['color'] }}; width: 20px;"></i>
                                <span>{{ $feature['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <ul class="list-group list-group-flush mb-0">
                    @foreach (array_slice($featureList, ceil(count($featureList) / 2)) as $feature)
                        <li class="list-group-item border-0 py-3 px-4" style="border-bottom: 1px solid #e5e5e5 !important; min-height: 62px;">
                            <a href="{{ $feature['url'] }}" class="text-dark text-decoration-none d-flex align-items-center h-100" style="font-size: 16px; font-weight: 500;">
                                <i class="{{ $feature['icon'] }} mr-3" style="color: {{ $feature['color'] }}; width: 20px;"></i>
                                <span>{{ $feature['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
