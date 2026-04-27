@extends ('layouts.app')
@section ('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-900 mb-4">
                    @if (auth()->user()->role === 'doctor')
                        {{ __('messages.dashboard_doctor') }}
                    @elseif (auth()->user()->role === 'admin')
                        {{ __('messages.dashboard_admin') }}
                    @else
                        {{ __('messages.dashboard_patient') }}
                    @endif
                </h1>
            </div>
        </div>
    </div>

@endsection
