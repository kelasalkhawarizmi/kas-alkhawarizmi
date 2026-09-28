<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Kelas VIII B AL-KHAWARIZMI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen p-3 md:p-6 font-sans text-slate-800">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Header Panel Modern -->
        <div class="bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 text-white rounded-2xl p-6 shadow-lg flex flex-col xl:flex-row justify-between items-start xl:items-center gap-5">
            <div>
                <span class="inline-block bg-blue-500/20 text-blue-200 border border-blue-400/30 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-semibold">Tahun Ajaran 2026/2027</span>
                <h1 class="text-2xl md:text-3xl font-black mt-2 tracking-tight">KAS KELAS VIII B AL-KHAWARIZMI</h1>
                <p class="text-blue-200 text-sm mt-1">Wali Kelas: <strong class="text-white">Ilham Nasrian, S.Pd</strong> • Iuran: <span class="bg-blue-800/80 px-2 py-0.5 rounded text-white font-medium">Rp 5.000 / Minggu</span></p>
            </div>
            
            <!-- Bilah Navigasi & Aksi -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Filter Periode Bulan & Tahun -->
                <form action="{{ route('kas.index') }}" method="GET" class="flex items-center gap-2 bg-white/10 p-1.5 rounded-xl border border-white/15 backdrop-blur-md">
                    <select name="bulan" class="rounded-lg px-3 py-2 text-xs font-semibold bg-white text-slate-800 focus:outline-none">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $bulanDipilih == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                    <select name="tahun" class="rounded-lg px-2.5 py-2 text-xs font-semibold bg-white text-slate-800 focus:outline-none">
                        @for ($y = date('Y') - 1; $y <= date('Y') + 1; $y++)
                            <option value="{{ $y }}" {{ $tahunDipilih == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition">Pilih</button>
                </form>

                <!-- Panel Cetak & Download PDF Berdasarkan Bendahara -->
                <form method="GET" class="flex items-center gap-1.5 bg-white/10 p-1.5 rounded-xl border border-white/15 backdrop-blur-md">
                    <input type="hidden" name="bulan" value="{{ $bulanDipilih }}">
                    <input type="hidden" name="tahun" value="{{ $tahunDipilih }}">
                    <select name="bendahara" id="pilihBendahara" class="rounded-lg px-2.5 py-2 text-xs font-semibold bg-white text-slate-800 focus:outline-none">
                        <option value="Cinta Putri Aypal">Bendahara 1: Cinta Putri Aypal</option>
                        <option value="Cheeryl Adeeva">Bendahara 2: Cheeryl Adeeva</option>
                    </select>

                    <button type="submit" formaction="{{ route('kas.cetakLaporan') }}" formtarget="_blank" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition shadow flex items-center gap-1.5" title="Buka Halaman Print">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Print
                    </button>

                    <button type="submit" formaction="{{ route('kas.downloadPdf') }}" class="bg-rose-600 hover:bg-rose-700 text-white px-3 py-2 rounded-lg text-xs font-bold transition shadow flex items-center gap-1.5" title="Unduh File PDF">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        PDF
                    </button>
                </form>

                <!-- Tombol Rekap Tahunan -->
                <a href="{{ route('kas.rekapTahunan', ['tahun' => $tahunDipilih]) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3.5 py-2.5 rounded-xl text-xs font-bold shadow transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Tahunan
                </a>

                <!-- Tombol Backup Data (HANYA MUNCUL UNTUK WALI KELAS) -->
                @if(Auth::user()->role === 'walas')
                    <a href="{{ route('kas.backupData') }}" class="bg-slate-700 hover:bg-slate-800 text-white p-2.5 rounded-xl text-xs font-bold shadow transition flex items-center justify-center" title="Unduh File Cadangan Data Kas (Wali Kelas)">
                        💾
                    </a>
                @endif

                <!-- Info Profil & Tombol Logout -->
                @auth
                <div class="flex items-center gap-2 pl-2 border-l border-white/20">
                    <div class="text-right hidden sm:block">
                        <div class="text-xs font-bold text-white">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-blue-300 uppercase tracking-wider font-semibold">
                            {{ Auth::user()->role === 'walas' ? 'Wali Kelas' : 'Bendahara' }}
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-rose-500/20 hover:bg-rose-600 text-rose-200 hover:text-white border border-rose-400/30 p-2 rounded-xl text-xs font-bold transition flex items-center gap-1" title="Keluar (Logout)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>

        <!-- Alert Notifikasi Sukses -->
        @if(session('success'))
            <div class="bg-emerald-600 text-white px-4 py-3 rounded-xl shadow text-sm font-medium flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <span class="text-xs bg-emerald-800 px-2 py-0.5 rounded">Sukses</span>
            </div>
        @endif

        <!-- Alert Notifikasi Error -->
        @if($errors->any())
            <div class="bg-rose-600 text-white px-4 py-3 rounded-xl shadow text-sm font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- 5 Kartu Ringkasan Keuangan -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Total Kas Masuk</p>
                <p class="text-xl md:text-2xl font-black text-emerald-600 mt-2">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Total Pengeluaran</p>
                <p class="text-xl md:text-2xl font-black text-rose-600 mt-2">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-blue-200 bg-blue-50/60">
                <p class="text-[11px] font-bold text-blue-700 uppercase tracking-wider">Sisa Saldo Kas</p>
                <p class="text-xl md:text-2xl font-black text-blue-900 mt-1">Rp {{ number_format($saldoKas, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-emerald-200 bg-emerald-50/40">
                <p class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Lunas Bulan Ini</p>
                <p class="text-xl md:text-2xl font-black text-emerald-700 mt-1">{{ $jumlahLunas ?? 0 }} <span class="text-xs font-normal text-slate-500">/ 24 Siswa</span></p>
            </div>
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-amber-200 bg-amber-50/40">
                <p class="text-[11px] font-bold text-amber-700 uppercase tracking-wider">Belum Lunas</p>
                <p class="text-xl md:text-2xl font-black text-amber-600 mt-1">{{ $jumlahBelumLunas ?? 24 }} <span class="text-xs font-normal text-slate-500">Siswa</span></p>
            </div>
        </div>

        <!-- Matriks Siswa & Pengeluaran -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Matriks 24 Siswa -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-5 overflow-x-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Daftar Iuran Kas Siswa (24 Siswa)</h2>
                        <span class="text-xs text-slate-500">Klik (+) bayar 5k, (✓) batalkan, atau ikon WA untuk pengingat</span>
                    </div>
                    <input type="text" id="searchInput" onkeyup="filterSiswa()" placeholder="🔍 Cari nama siswa..." class="w-full sm:w-60 border border-slate-300 rounded-xl px-3.5 py-2 text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <table class="w-full text-left text-sm" id="tableSiswa">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 text-xs font-bold uppercase border-y border-slate-200">
                            <th class="py-3 px-3">No</th>
                            <th class="py-3 px-3">Nama Siswa</th>
                            <th class="py-3 px-2 text-center">M-1</th>
                            <th class="py-3 px-2 text-center">M-2</th>
                            <th class="py-3 px-2 text-center">M-3</th>
                            <th class="py-3 px-2 text-center">M-4</th>
                            <th class="py-3 px-2 text-right">Terbayar</th>
                            <th class="py-3 px-3 text-center">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($students as $idx => $student)
                            @php
                                $bayarWeeks = $student->kasEntries->keyBy('minggu_ke');
                                $count = $bayarWeeks->count();
                                $isLunas = $count >= 4;
                                $totalTerbayar = $count * 5000;
                                $sisaTunggakan = 20000 - $totalTerbayar;
                                $namaBulanAktif = \Carbon\Carbon::create()->month($bulanDipilih)->translatedFormat('F');

                                $pesanWa = urlencode("Assalamu'alaikum wr. wb.\n\nMengingatkan iuran kas kelas VIII B (Al-Khawarizmi) an. {$student->nama} bulan {$namaBulanAktif} {$tahunDipilih}.\nSaat ini baru terbayar Rp " . number_format($totalTerbayar, 0, ',', '.') . " dari Rp 20.000 (Kurang: Rp " . number_format($sisaTunggakan, 0, ',', '.') . ").\n\nTerima kasih. 🙏");
                            @endphp
                            <tr class="hover:bg-blue-50/40 transition baris-siswa">
                                <td class="py-3 px-3 text-slate-500 font-semibold text-xs">{{ $idx + 1 }}</td>
                                <td class="py-3 px-3">
                                    <div class="font-bold text-slate-900 nama-siswa text-sm">{{ $student->nama }}</div>
                                    <span class="text-xs text-slate-500 font-mono">NISN: {{ $student->nis ?? '-' }} • {{ $student->jenis_kelamin }}</span>
                                </td>

                                <!-- Minggu 1 s.d 4 -->
                                @for($w = 1; $w <= 4; $w++)
                                    <td class="py-3 px-2 text-center">
                                        @if($bayarWeeks->has($w))
                                            <form action="{{ route('kas.batalBayar', $bayarWeeks[$w]->id) }}" method="POST" onsubmit="return confirm('Batalkan pembayaran Minggu ke-{{ $w }} untuk {{ $student->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center w-7 h-7 bg-emerald-100 hover:bg-rose-100 text-emerald-800 hover:text-rose-700 rounded-full font-bold text-xs transition border border-emerald-300" title="Klik untuk membatalkan">✓</button>
                                            </form>
                                        @else
                                            <form action="{{ route('kas.bayarMingguan') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                <input type="hidden" name="minggu_ke" value="{{ $w }}">
                                                <input type="hidden" name="bulan" value="{{ $bulanDipilih }}">
                                                <input type="hidden" name="tahun" value="{{ $tahunDipilih }}">
                                                <button type="submit" class="w-7 h-7 bg-slate-100 hover:bg-emerald-500 hover:text-white rounded-full text-slate-600 text-xs font-bold border border-slate-300 transition" title="Bayar Rp5.000">+</button>
                                            </form>
                                        @endif
                                    </td>
                                @endfor

                                <!-- Kolom Total Terbayar -->
                                <td class="py-3 px-2 text-right font-bold text-xs {{ $isLunas ? 'text-emerald-700' : 'text-slate-700' }}">
                                    Rp {{ number_format($totalTerbayar, 0, ',', '.') }}
                                </td>

                                <!-- Aksi Cepat -->
                                <td class="py-3 px-3 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        @if($isLunas)
                                            <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-2.5 py-1 rounded-md border border-emerald-300">Lunas</span>
                                        @else
                                            <form action="{{ route('kas.bayarBulanan') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                <input type="hidden" name="bulan" value="{{ $bulanDipilih }}">
                                                <input type="hidden" name="tahun" value="{{ $tahunDipilih }}">
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-2.5 py-1.5 rounded-lg transition shadow-sm whitespace-nowrap">
                                                    Lunas 20k
                                                </button>
                                            </form>

                                            <a href="https://api.whatsapp.com/send?text={{ $pesanWa }}" target="_blank" class="p-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs transition shadow-sm" title="Kirim Pengingat Kas via WA">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Panel Pengeluaran -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
                    <h2 class="text-base font-bold text-slate-900 mb-4">Catat Pengeluaran</h2>
                    <form action="{{ route('kas.storeExpense') }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Keperluan / Barang</label>
                            <input type="text" name="deskripsi" placeholder="Contoh: Beli spidol & penghapus" required class="w-full border border-slate-300 rounded-xl p-2.5 text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Nominal (Rp)</label>
                            <input type="number" name="jumlah" min="500" step="500" placeholder="Contoh: 15000" required class="w-full border border-slate-300 rounded-xl p-2.5 text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kategori</label>
                            <select name="kategori" class="w-full border border-slate-300 rounded-xl p-2.5 text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                                <option value="Operasional Kelas">Operasional Kelas</option>
                                <option value="Kebersihan">Kebersihan</option>
                                <option value="Alat Tulis & Fotokopi">Alat Tulis & Fotokopi</option>
                                <option value="Sosial / Jenguk Teman">Sosial / Jenguk Teman</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required class="w-full border border-slate-300 rounded-xl p-2.5 text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-2.5 rounded-xl text-xs transition shadow-sm mt-2">
                            Simpan Pengeluaran
                        </button>
                    </form>
                </div>

                <!-- 10 Pengeluaran Terakhir -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
                    <h3 class="text-sm font-bold text-slate-800 mb-3">Pengeluaran Terakhir</h3>
                    <div class="space-y-3">
                        @forelse($daftarPengeluaran as $exp)
                            <div class="flex justify-between items-center text-xs border-b border-slate-100 pb-2">
                                <div>
                                    <p class="font-bold text-slate-800">{{ $exp->deskripsi }}</p>
                                    <span class="text-slate-500">{{ \Carbon\Carbon::parse($exp->tanggal)->translatedFormat('d M Y') }} • {{ $exp->kategori }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-rose-600">-Rp {{ number_format($exp->jumlah, 0, ',', '.') }}</span>
                                    
                                    <!-- TOMBOL HAPUS HANYA MUNCUL JIKA LOGIN SEBAGAI WALI KELAS -->
                                    @if(Auth::user()->role === 'walas')
                                        <form action="{{ route('kas.destroyExpense', $exp->id) }}" method="POST" onsubmit="return confirm('Hapus catatan pengeluaran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-300 hover:text-rose-600 font-bold px-1" title="Hapus (Wali Kelas)">✕</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 text-center py-3">Belum ada catatan pengeluaran.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Script Filter Pencarian Siswa -->
    <script>
        function filterSiswa() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let rows = document.querySelectorAll('.baris-siswa');

            rows.forEach(function(row) {
                let nama = row.querySelector('.nama-siswa').innerText.toLowerCase();
                if (nama.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>