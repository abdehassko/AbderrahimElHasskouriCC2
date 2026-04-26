<footer class="bg-slate-900 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Clinic Info -->
            <div>
                <h3 class="text-xl font-semibold text-blue-400 mb-4">
                    {{ __('messages.clinic_name') }}
                </h3>
                <p class="text-slate-300 mb-4">
                    {{ __('messages.clinic_description') }}
                </p>
                <p class="text-slate-400">
                    &copy; {{ date('Y') }} {{ __('messages.clinic_name') }}. {{ __('messages.rights') }}
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">
                    {{ __('messages.quick_links') }}
                </h4>
                <ul class="space-y-2">
                    <li>
                        <a
                            href="{{ route('appointments.index') }}"
                            class="text-slate-300 hover:text-blue-300 transition"
                        >
                            {{ __('messages.appointments_nav') }}
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="text-slate-300 hover:text-blue-300 transition"
                        >
                            {{ __('messages.doctors') }}
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="text-slate-300 hover:text-blue-300 transition"
                        >
                            {{ __('messages.patients') }}
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="text-slate-300 hover:text-blue-300 transition"
                        >
                            {{ __('messages.services') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-4">
                    {{ __('messages.contact_us') }}
                </h4>
                <p class="text-slate-300 mb-2">
                    {{ __('messages.address') }}: 123 Medical Street,
                    Casablanca, Morocco
                </p>
                <p class="text-slate-300 mb-2">
                    {{ __('messages.phone') }}: +212 123 456 789
                </p>
                <p class="text-slate-300">
                    {{ __('messages.email') }}: info@cliniquedemaroc.ma
                </p>
            </div>
        </div>
    </div>
</footer>
