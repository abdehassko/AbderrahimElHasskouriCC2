<nav
    x-data="{ open: false }"
    class="sticky top-0 z-50 bg-slate-900/80 backdrop-blur-lg border-b border-blue-500/10 shadow-md"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->

            <span class="text-blue-300 font-semibold text-sm hidden sm:block">
                Gestion des rendez vous
            </span>

            <!-- Right Side -->
            <div class="flex items-center gap-3">
                <!-- Language -->

                @include ('partials.language-switcher')

                <!-- User Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="40">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 hover:bg-blue-500/20 transition"
                            >
                                <!-- Avatar -->
                                <div
                                    class="w-7 h-7 rounded-full bg-blue-500 flex items-center justify-center text-xs font-bold text-white"
                                >
                                    Logout
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div
                                class="bg-white-700/90 backdrop-blur-lg border border-blue-500/20 rounded-xl shadow-lg"
                            >
                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                >
                                    @csrf
                                    <x-dropdown-link
                                        :href="route('logout')"
                                        onclick="
                                            event.preventDefault();
                                            this.closest('form').submit();
                                        "
                                        class="hover:bg-red-500/10 hover:text-red-400"
                                    >
                                        {{ __('Logout') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="flex items-center sm:hidden">
                    <button
                        @click="open = !open"
                        class="p-2 rounded-md text-blue-300 hover:bg-blue-500/20 transition"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{ hidden: open, 'inline-flex': !open }"
                                class="inline-flex"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{ hidden: !open, 'inline-flex': open }"
                                class="hidden"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div
        :class="{ block: open, hidden: !open }"
        class="hidden sm:hidden bg-slate-900/90 backdrop-blur-lg border-t border-blue-500/10"
    >
        <div class="px-4 py-4 space-y-2">
            <x-responsive-nav-link
                :href="route('profile.edit')"
                class="text-blue-200"
            >
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link
                    :href="route('logout')"
                    onclick="
                        event.preventDefault();
                        this.closest('form').submit();
                    "
                    class="text-red-400"
                >
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
