<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kas Kelas VIII B AL-KHAWARIZMI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-br from-blue-900 via-indigo-900 to-slate-900 p-8 text-center text-white relative">
            <span class="inline-block bg-blue-500/20 text-blue-300 border border-blue-400/30 text-[10px] px-3 py-1 rounded-full uppercase tracking-widest font-bold">
                Sistem Keamanan Kas Kelas
            </span>
            <h1 class="text-2xl font-black mt-3 tracking-tight">KAS KELAS VIII B</h1>
            <p class="text-blue-200 text-xs mt-1">Kelas Al-Khawarizmi • TA 2026/2027</p>
        </div>

        <div class="p-8 space-y-6">

            @if(session('success'))
                <div class="bg-emerald-50 text-emerald-800 border border-emerald-200 p-3 rounded-xl text-xs font-semibold text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 text-rose-700 border border-rose-200 p-3 rounded-xl text-xs font-semibold">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required autofocus
                        placeholder="Masukkan username"
                        class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-800 font-medium focus:bg-white focus:ring-2 focus:ring-blue-600 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Password</label>
                    <input type="password" name="password" required
                        placeholder="••••••••"
                        class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-800 font-medium focus:bg-white focus:ring-2 focus:ring-blue-600 focus:outline-none transition">
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-blue-600 border-slate-300 focus:ring-blue-500 mr-2">
                        Ingat Saya
                    </label>
                </div>

                <button type="submit" class="w-full bg-blue-900 hover:bg-indigo-900 text-white font-bold py-3.5 rounded-xl text-sm transition shadow-lg shadow-blue-900/20 active:scale-[0.99] tracking-wide mt-2">
                    Masuk ke Sistem Kas
                </button>
            </form>

            <div class="border-t border-slate-100 pt-4 text-center">
                <p class="text-[11px] text-slate-400">Hak Akses Terproteksi: <strong>Wali Kelas</strong> & <strong>Bendahara</strong></p>
            </div>
        </div>

    </div>

</body>
</html>