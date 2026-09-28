<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Tahunan Kas Kelas VIII B AL-KHAWARIZMI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-100 min-h-screen p-3 md:p-6 font-sans">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Header -->
        <div class="bg-indigo-900 text-white rounded-2xl p-6 shadow-md flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <a href="{{ route('kas.index') }}" class="text-xs text-indigo-300 hover:text-white flex items-center gap-1 font-semibold mb-2">
                    ← Kembali ke Dashboard Bulanan
                </a>
                <h1 class="text-2xl md:text-3xl font-black tracking-tight">REKAP KAS TAHUNAN KELAS VIII B</h1>
                <p class="text-indigo-200 text-sm mt-1">Tahun Ajaran / Kalender: {{ $tahunDipilih }}</p>
            </div>
            
            <form action="{{ route('kas.rekapTahunan') }}" method="GET" class="flex items-center gap-2 bg-white/10 p-2 rounded-xl backdrop-blur-sm">
                <select name="tahun" class="rounded-lg px-3 py-2 text-sm bg-white text-gray-800 font-medium">
                    @for ($y = date('Y') - 1; $y <= date('Y') + 1; $y++)
                        <option value="{{ $y }}" {{ $tahunDipilih == $y ? 'selected' : '' }}>Tahun {{ $y }}</option>
                    @endfor
                </select>
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">Pilih</button>
            </form>
        </div>

        <!-- 3 Kartu Saldo Tahunan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Kas Masuk Tahun {{ $tahunDipilih }}</p>
                <p class="text-2xl font-black text-emerald-600 mt-2">Rp {{ number_format($totalPemasukanTahun, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pengeluaran Tahun {{ $tahunDipilih }}</p>
                <p class="text-2xl font-black text-rose-600 mt-2">Rp {{ number_format($totalPengeluaranTahun, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 bg-indigo-50/50">
                <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Sisa Saldo Kas Tahun {{ $tahunDipilih }}</p>
                <p class="text-3xl font-black text-indigo-900 mt-1">Rp {{ number_format($saldoTahun, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Visualisasi Grafik Keuangan (Chart.js) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Diagram Batang Arus Kas Per Bulan -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
                <h2 class="text-base font-bold text-slate-800 mb-1">Grafik Arus Kas Bulanan</h2>
                <p class="text-xs text-slate-400 mb-4">Perbandingan pemasukan vs pengeluaran setiap bulan</p>
                <div class="h-64">
                    <canvas id="barChartKas"></canvas>
                </div>
            </div>

            <!-- Diagram Donat Kategori Pengeluaran -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 flex flex-col justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-800 mb-1">Kategori Pengeluaran</h2>
                    <p class="text-xs text-slate-400 mb-4">Alokasi dana kas kelas</p>
                </div>
                <div class="h-64 flex items-center justify-center">
                    <canvas id="doughnutChartKas"></canvas>
                </div>
            </div>
        </div>

        <!-- Matriks 12 Bulan -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 overflow-x-auto">
            <h2 class="text-base font-bold text-slate-800 mb-4">Matriks Pembayaran 24 Siswa (Januari - Desember)</h2>
            <table class="w-full text-left text-xs whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 uppercase border-y border-slate-200">
                        <th class="py-3 px-2">No</th>
                        <th class="py-3 px-3">Nama Siswa</th>
                        @for($m = 1; $m <= 12; $m++)
                            <th class="py-3 px-2 text-center">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('M') }}</th>
                        @endfor
                        <th class="py-3 px-3 text-right">Total Akumulasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($students as $idx => $student)
                        @php
                            $totalAkumulasiSiswa = 0;
                        @endphp
                        <tr class="hover:bg-slate-50">
                            <td class="py-2.5 px-2 text-slate-400">{{ $idx + 1 }}</td>
                            <td class="py-2.5 px-3 font-semibold text-slate-800">{{ $student->nama }}</td>
                            @for($m = 1; $m <= 12; $m++)
                                @php
                                    $nominalBulan = $student->kasEntries->where('bulan', $m)->sum('jumlah');
                                    $totalAkumulasiSiswa += $nominalBulan;
                                @endphp
                                <td class="py-2.5 px-2 text-center">
                                    @if($nominalBulan >= 20000)
                                        <span class="inline-block bg-emerald-100 text-emerald-700 font-bold px-1.5 py-0.5 rounded text-[10px]">20k</span>
                                    @elseif($nominalBulan > 0)
                                        <span class="inline-block bg-amber-100 text-amber-800 font-bold px-1.5 py-0.5 rounded text-[10px]">{{ $nominalBulan / 1000 }}k</span>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                            @endfor
                            <td class="py-2.5 px-3 text-right font-black text-indigo-900">
                                Rp {{ number_format($totalAkumulasiSiswa, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Script Render Chart.js -->
    <script>
        const ctxBar = document.getElementById('barChartKas').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    {
                        label: 'Pemasukan (Rp)',
                        data: {!! json_encode($chartPemasukan) !!},
                        backgroundColor: '#10b981',
                        borderRadius: 6
                    },
                    {
                        label: 'Pengeluaran (Rp)',
                        data: {!! json_encode($chartPengeluaran) !!},
                        backgroundColor: '#f43f5e',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(val) {
                                return 'Rp ' + val.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        const ctxDoughnut = document.getElementById('doughnutChartKas').getContext('2d');
        const kategoriData = {!! json_encode($kategoriExpenses) !!};
        const labelsDoughnut = Object.keys(kategoriData);
        const valuesDoughnut = Object.values(kategoriData);

        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: labelsDoughnut.length > 0 ? labelsDoughnut : ['Belum Ada Pengeluaran'],
                datasets: [{
                    data: valuesDoughnut.length > 0 ? valuesDoughnut : [1],
                    backgroundColor: valuesDoughnut.length > 0 ? ['#3b82f6', '#f59e0b', '#ec4899', '#8b5cf6', '#64748b'] : ['#e2e8f0']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12, font: { size: 10 } }
                    }
                }
            }
        });
    </script>
</body>
</html>