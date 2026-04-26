<div class="relative inline-block text-left" x-data="{ open: false }">
    <div>
        <button
            type="button"
            @click="open = !open"
            class="inline-flex justify-center w-full rounded-md border border-gray-700 shadow-sm px-4 py-2 bg-gray-800 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500"
            id="language-menu-button"
            aria-expanded="true"
            aria-haspopup="true"
        >
            @php
                $locales = [
                    'en' => ['name' => 'English', 'flag' => '🇺🇸'],
                    'fr' => ['name' => 'Français', 'flag' => '🇫🇷'],
                    'ar' => ['name' => 'العربية', 'flag' => '🇲🇦'],
                ];
                $currentLocale = app()->getLocale();
            @endphp
            <span
                class="mr-2"
                >{{ $locales[$currentLocale]['flag'] ?? $locales['fr']['flag'] }}</span
            >
            {{ $locales[$currentLocale]['name'] ?? 'Français' }} <!-- Heroicon name: solid/chevron-down -->
            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div
        x-show="open"
        @click.away="open = false"
        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="language-menu-button"
        tabindex="-1"
    >
        <div class="py-1" role="none">
            @foreach ($locales as $code => $lang)
                <a
                    href="{{ route('lang.switch', $code) }}"
                    class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 flex items-center"
                    role="menuitem"
                    tabindex="-1"
                >
                    <span class="mr-3 text-lg">{{ $lang['flag'] }}</span>
                    <span>{{ $lang['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
