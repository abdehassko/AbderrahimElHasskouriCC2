<x-guest-layout>
    <div
        class="w-full max-w-md space-y-8 backdrop-blur-xl bg-gradient-to-br from-white via-slate-50 to-indigo-50/80 dark:from-slate-900 dark:via-slate-950 dark:to-indigo-900/80 border border-slate-200/70 dark:border-slate-700/80 shadow-2xl shadow-indigo-500/10 rounded-[2rem] p-10 ring-1 ring-white/70"
    >
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label
                    for="email"
                    :value="__('Email')"
                    class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2"
                />
                <x-text-input
                    id="email"
                    class="block w-full rounded-3xl border border-slate-300 bg-slate-50/90 px-4 py-3 text-slate-900 shadow-sm transition duration-200 ease-in-out focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label
                    for="password"
                    :value="__('Password')"
                    class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2"
                />

                <x-text-input
                    id="password"
                    class="block w-full rounded-3xl border border-slate-300 bg-slate-50/90 px-4 py-3 text-slate-900 shadow-sm transition duration-200 ease-in-out focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />

                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center gap-3">
                <label for="remember_me" class="inline-flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="h-5 w-5 rounded-xl border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        name="remember"
                    />
                    <span
                        class="ms-2 text-sm text-slate-600 dark:text-slate-300"
                        >{{ __('Remember me') }}</span
                    >
                </label>
            </div>

            <div
                class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
            >
                @if (Route::has('password.request'))
                    <a
                        class="text-sm text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white rounded-full transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button
                    class="w-full sm:w-auto rounded-3xl px-6 py-3 bg-indigo-600 hover:bg-indigo-500 focus:ring-indigo-400"
                >
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
