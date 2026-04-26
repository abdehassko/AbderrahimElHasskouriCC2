<aside
    class="w-64 h-screen bg-slate-900 border-r border-blue-500/10 fixed top-0 left-0 flex flex-col"
>
    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-blue-500/10">
        <span class="text-blue-400 font-semibold text-lg"> Clinique </span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg text-slate-300 hover:bg-blue-500/10 hover:text-blue-300 transition"
        >
            🏠 Dashboard
        </a>

        <a
            href="#"
            class="flex items-center gap-3 px-4 py-2 rounded-lg text-slate-300 hover:bg-blue-500/10 hover:text-blue-300 transition"
        >
            👨‍⚕️ Doctors
        </a>

        <a
            href="#"
            class="flex items-center gap-3 px-4 py-2 rounded-lg text-slate-300 hover:bg-blue-500/10 hover:text-blue-300 transition"
        >
            🧑‍🤝‍🧑 Patients
        </a>

        <a
            href="#"
            class="flex items-center gap-3 px-4 py-2 rounded-lg text-slate-300 hover:bg-blue-500/10 hover:text-blue-300 transition"
        >
            🏥 Services
        </a>
    </nav>

    <!-- Bottom User -->
    <div class="p-4 border-t border-blue-500/10">
        <div class="flex items-center gap-3">
            <div
                class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-bold"
            >
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-sm text-white">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400">Admin</p>
            </div>
        </div>
    </div>
</aside>
