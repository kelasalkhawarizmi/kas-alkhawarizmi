<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kas Kelas VIII B AL-KHAWARIZMI</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 15mm 15mm 15mm;
        }
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            font-size: 11px; 
            color: #1e293b; 
            line-height: 1.4;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }
        
        /* Tombol Cetak Browser */
        .no-print-bar {
            margin-bottom: 20px;
            text-align: right;
            padding: 10px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }
        .btn-print {
            padding: 8px 20px;
            background: #1e3a8a;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.3px;
        }
        .btn-print:hover {
            background: #172554;
        }

        /* Kop Laporan Resmi */
        .kop-surat {
            text-align: center;
            border-bottom: 3px double #0f172a;
            padding-bottom: 8px;
            margin-bottom: 14px;
        }
        .kop-surat .lembaga {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #0f172a;
            text-transform: uppercase;
            margin: 0;
        }
        .kop-surat .sub-lembaga {
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            margin: 2px 0 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kop-surat .info-periode {
            font-size: 11px;
            color: #475569;
            margin-top: 4px;
        }

        /* 3 Box Ringkasan Keuangan */
        .summary-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin-bottom: 14px;
        }
        .summary-card {
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
            border-radius: 6px;
            padding: 8px 10px;
            text-align: center;
            width: 33.33%;
        }
        .summary-card.highlight {
            background-color: #eff6ff;
            border-color: #93c5fd;
        }
        .summary-title {
            font-size: 9.5px;
            text-transform: uppercase;
            font-weight: 700;
            color: #64748b;
            letter-spacing: 0.5px;
        }
        .summary-card.highlight .summary-title {
            color: #1d4ed8;
        }
        .summary-val {
            font-size: 14px;
            font-weight: 800;
            color: #0f172a;
            margin-top: 3px;
        }
        .summary-card.highlight .summary-val {
            color: #1e3a8a;
        }

        /* Judul Seksi */
        .section-heading {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 12px 0 6px;
            padding-left: 6px;
            border-left: 3px solid #1e3a8a;
        }

        /* Desain Tabel Bersih & Elegan */
        table.data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 12px; 
            font-size: 10px;
        }
        table.data-table th { 
            background-color: #0f172a; 
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            padding: 6px 5px;
            border: 1px solid #0f172a;
            letter-spacing: 0.3px;
            font-size: 9.5px;
        }
        table.data-table td { 
            border: 1px solid #cbd5e1; 
            padding: 4.5px 6px; 
            color: #1e293b;
        }
        table.data-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        
        .badge-lunas {
            display: inline-block;
            background: #dcfce7;
            color: #15803d;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 9px;
            border: 1px solid #86efac;
        }
        .badge-belum {
            display: inline-block;
            background: #fee2e2;
            color: #b91c1c;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 9px;
            border: 1px solid #fca5a5;
        }

        /* Area Tanda Tangan */
        .ttd-wrapper { 
            width: 100%; 
            margin-top: 25px; 
            page-break-inside: avoid;
        }
        .ttd-wrapper td { 
            border: none; 
            text-align: center; 
            width: 50%; 
            font-size: 11px; 
            vertical-align: top; 
            color: #0f172a;
        }
        .ttd-nama {
            font-weight: 800;
            text-decoration: underline;
            font-size: 11.5px;
        }
        .ttd-nomor {
            font-size: 10px;
            color: #475569;
            margin-top: 2px;
        }

        @media print {
            .no-print { 
                display: none !important; 
            }
            body { 
                padding: 0; 
            }
            .summary-card, .summary-card.highlight {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            table.data-table th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <!-- Tombol Cetak (Hanya tampil di browser layar, otomatis lenyap di cetakan PDF) -->
    <div class="no-print no-print-bar">
        <button onclick="window.print()" class="btn-print">
            Cetak Dokumen Sekarang (Print)
        </button>
    </div>

    <!-- Kop Surat Resmi -->
    <div class="kop-surat">
        <h1 class="lembaga">Laporan Keuangan Kas Kelas VIII B</h1>
        <h2 class="sub-lembaga">Kelas Al-Khawarizmi • Tahun Ajaran 2026/2027</h2>
        <div class="info-periode">
            Periode: <strong>{{ strtoupper(\Carbon\Carbon::create()->month($bulanDipilih)->translatedFormat('F')) }} {{ $tahunDipilih }}</strong> 
            • Ketentuan Kas: Rp 5.000 / Minggu (Rp 20.000 / Bulan)
        </div>
    </div>

    <!-- 3 Box Ikhtisar Keuangan -->
    <table class="summary-grid">
        <tr>
            <td class="summary-card">
                <div class="summary-title">Pemasukan Bulan Ini</div>
                <div class="summary-val" style="color: #16a34a;">Rp {{ number_format($totalPemasukanBulanIni, 0, ',', '.') }}</div>
            </td>
            <td class="summary-card">
                <div class="summary-title">Pengeluaran Bulan Ini</div>
                <div class="summary-val" style="color: #dc2626;">Rp {{ number_format($totalPengeluaranBulanIni, 0, ',', '.') }}</div>
            </td>
            <td class="summary-card highlight">
                <div class="summary-title">Total Saldo Kas Tersisa</div>
                <div class="summary-val">Rp {{ number_format($saldoKas, 0, ',', '.') }}</div>
            </td>
        </tr>
    </table>

    <!-- Bagian 1: Matriks Iuran Siswa -->
    <div class="section-heading">1. Rekapitulasi Iuran Kas Siswa (24 Siswa)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 13%;">NISN</th>
                <th>Nama Lengkap Siswa</th>
                <th style="width: 7%;">M-1</th>
                <th style="width: 7%;">M-2</th>
                <th style="width: 7%;">M-3</th>
                <th style="width: 7%;">M-4</th>
                <th style="width: 14%;">Terbayar</th>
                <th style="width: 11%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $idx => $s)
                @php
                    $bayarCount = $s->kasEntries->count();
                    $nominal = $bayarCount * 5000;
                    $weeks = $s->kasEntries->pluck('minggu_ke')->toArray();
                @endphp
                <tr>
                    <td class="text-center" style="color: #64748b;">{{ $idx + 1 }}</td>
                    <td class="text-center font-mono">{{ $s->nis ?? '-' }}</td>
                    <td style="font-weight: 600;">{{ $s->nama }}</td>
                    <td class="text-center" style="font-weight: 700; color: {{ in_array(1, $weeks) ? '#16a34a' : '#cbd5e1' }};">
                        {{ in_array(1, $weeks) ? '✓' : '-' }}
                    </td>
                    <td class="text-center" style="font-weight: 700; color: {{ in_array(2, $weeks) ? '#16a34a' : '#cbd5e1' }};">
                        {{ in_array(2, $weeks) ? '✓' : '-' }}
                    </td>
                    <td class="text-center" style="font-weight: 700; color: {{ in_array(3, $weeks) ? '#16a34a' : '#cbd5e1' }};">
                        {{ in_array(3, $weeks) ? '✓' : '-' }}
                    </td>
                    <td class="text-center" style="font-weight: 700; color: {{ in_array(4, $weeks) ? '#16a34a' : '#cbd5e1' }};">
                        {{ in_array(4, $weeks) ? '✓' : '-' }}
                    </td>
                    <td class="text-right font-bold">Rp {{ number_format($nominal, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if($bayarCount >= 4)
                            <span class="badge-lunas">Lunas</span>
                        @else
                            <span class="badge-belum">Belum</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bagian 2: Rincian Pengeluaran -->
    <div class="section-heading">2. Rincian Pengeluaran Kas Periode Ini</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 14%;">Tanggal</th>
                <th>Uraian / Keperluan Barang</th>
                <th style="width: 22%;">Kategori</th>
                <th style="width: 18%;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengeluaranBulanIni as $i => $item)
                <tr>
                    <td class="text-center" style="color: #64748b;">{{ $i + 1 }}</td>
                    <td class="text-center font-mono">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td style="font-weight: 600;">{{ $item->deskripsi }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td class="text-right font-bold" style="color: #dc2626;">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="color: #64748b; font-style: italic; padding: 10px;">
                        Tidak ada riwayat catatan pengeluaran pada periode bulan ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @php
        // Ambil data NISN otomatis berdasarkan bendahara yang dipilih
        $namaBendahara = $bendahara ?? 'Cinta Putri Aypal';
        $siswaBendahara = $students->firstWhere('nama', $namaBendahara);
        $nisnBendahara = $siswaBendahara ? $siswaBendahara->nis : ($namaBendahara == 'Cheeryl Adeeva' ? '1498' : '1499');
    @endphp

    <!-- Pengesahan / Tanda Tangan Resmi -->
    <table class="ttd-wrapper">
        <tr>
            <td>
                Mengetahui,<br>
                <strong>Wali Kelas VIII B</strong>
                <br><br><br><br><br>
                <div class="ttd-nama">Ilham Nasrian, S.Pd</div>
                <div class="ttd-nomor">NRP. 20230724819990405</div>
            </td>
            <td>
                {{ date('d') }} {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}<br>
                <strong>Bendahara Kelas VIII B</strong>
                <br><br><br><br><br>
                <div class="ttd-nama">{{ $namaBendahara }}</div>
                <div class="ttd-nomor">NISN. {{ $nisnBendahara }}</div>
            </td>
        </tr>
    </table>

</body>
</html>