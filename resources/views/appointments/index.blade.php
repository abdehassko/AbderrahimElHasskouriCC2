@extends ('layouts.app')

@section ('content')
    <div class="w-full">
        <input
            type="text"
            id="search"
            class="form-control mb-3"
            placeholder="{{ __('messages.search') }}"
        />
        <button
            class="btn btn-primary mb-3"
            data-bs-toggle="modal"
            data-bs-target="#createModal"
        >
            {{ __('messages.add') }}
        </button>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered" id="appointmentsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('messages.patient') }}</th>
                    <th>{{ __('messages.doctor') }}</th>
                    <th>{{ __('messages.service') }}</th>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>

            <tbody id="tableBody">
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>
                            {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                        </td>
                        <td>
                            {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
                        </td>
                        <td>{{ $appointment->service->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ __('messages.' . $appointment->status) }}</td>
                        <td>
                            <button
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#showModal{{ $appointment->id }}"
                            >
                                {{ __('messages.show') }}
                            </button>

                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $appointment->id }}"
                            >
                                {{ __('messages.edit') }}
                            </button>

                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $appointment->id }}"
                            >
                                {{ __('messages.delete') }}
                            </button>
                        </td>
                    </tr>
                    <div
                        class="modal fade"
                        id="showModal{{ $appointment->id }}"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>
                                    {{ __('messages.appointment_details') }}
                                </h4>

                                <p><b>{{ __('messages.patient') }}:</b> {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>
                                <p><b>{{ __('messages.email') }}:</b> {{ $appointment->patient->email }}</p>
                                <p><b>{{ __('messages.doctor') }}:</b> {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</p>
                                <p><b>{{ __('messages.service') }}:</b> {{ $appointment->service->name }}</p>
                                <p><b>{{ __('messages.date') }}:</b> {{ $appointment->appointment_date }}</p>
                                <p><b>{{ __('messages.status') }}:</b> {{ __('messages.' . $appointment->status) }}</p>

                                <button
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    {{ __('messages.close') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="modal fade"
                        id="editModal{{ $appointment->id }}"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>{{ __('messages.edit_appointment') }}</h4>

                                <form
                                    method="POST"
                                    action="{{ route('appointments.update', $appointment->id) }}"
                                >
                                    @csrf
                                    <input
                                        type="hidden"
                                        name="_method"
                                        value="PUT"
                                    />

                                    <label>{{ __('messages.patient') }}</label>
                                    <select
                                        name="patient_id"
                                        class="form-control"
                                    >
                                        @if (auth()->user()->role !== 'patient')
                                            @foreach (\App\Models\User::where('role','patient')->get() as $patient)
                                                <option
                                                    value="{{ $patient->id }}"
                                                    {{ $patient->id ==  $appointment->patient_id ? 'selected' : '' }}
                                                >
                                                    {{ $patient->first_name }} {{ $patient->last_name }}
                                                </option>
                                            @endforeach

                                        @else
                                            <option
                                                value="{{ auth()->user()->id }}"
                                                {{ auth()->user()->id ==  auth()->user()->id ? 'selected' : '' }}
                                            >
                                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                            </option>
                                        @endif
                                    </select>

                                    <label>{{ __('messages.doctor') }}</label>
                                    <select
                                        name="doctor_id"
                                        class="form-control"
                                    >
                                        @if (auth()->user()->role !== 'doctor')
                                            @foreach (\App\Models\User::where('role','doctor')->get() as $doctor)
                                                <option
                                                    value="{{ $doctor->id }}"
                                                    {{ $doctor->id ==  $appointment->doctor_id ? 'selected' : '' }}
                                                >
                                                    {{ $doctor->first_name }} {{ $doctor->last_name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option
                                                value="{{ auth()->user()->id }}"
                                                {{ auth()->user()->id ==  auth()->user()->id ? 'selected' : '' }}
                                            >
                                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                            </option>
                                        @endif
                                    </select>

                                    <label>{{ __('messages.service') }}</label>
                                    <select
                                        name="service_id"
                                        class="form-control mt-2"
                                    >
                                        @foreach (\App\Models\Service::all() as $service)
                                            <option
                                                value="{{ $service->id }}"
                                                {{ $service->id ==  $appointment->service_id ? 'selected' : '' }}
                                            >
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <label>{{ __('messages.date') }}</label>
                                    <input
                                        type="datetime-local"
                                        name="appointment_date"
                                        class="form-control"
                                        value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i') }}"
                                    />

                                    <label>{{ __('messages.status') }}</label>
                                    @if (auth()->user()->role !== 'patient')
                                        <select
                                            name="status"
                                            class="form-control mt-2"
                                        >
                                            <option
                                                value="pending"
                                                {{ $appointment->status == 'pending' ? 'selected' : '' }}
                                            >
                                                {{ __('messages.pending') }}
                                            </option>
                                            <option
                                                value="confirmed"
                                                {{ $appointment->status == 'confirmed' ? 'selected' : '' }}
                                            >
                                                {{ __('messages.confirmed') }}
                                            </option>
                                            <option
                                                value="cancelled"
                                                {{ $appointment->status == 'cancelled' ? 'selected' : '' }}
                                            >
                                                {{ __('messages.cancelled') }}
                                            </option>
                                        </select>

                                    @else
                                        <select
                                            name="status"
                                            class="form-control mt-2"
                                        >
                                            <option
                                                value="pending"
                                                {{ $appointment->status == 'pending' ? 'selected' : '' }}
                                            >
                                                {{ __('messages.pending') }}
                                            </option>

                                            <option
                                                value="cancelled"
                                                {{ $appointment->status == 'cancelled' ? 'selected' : '' }}
                                            >
                                                {{ __('messages.cancelled') }}
                                            </option>
                                        </select>

                                    @endif

                                    <button
                                        type="submit"
                                        class="btn btn-success mt-3"
                                    >
                                        {{ __('messages.update') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div
                        class="modal fade"
                        id="deleteModal{{ $appointment->id }}"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>{{ __('messages.confirm_delete') }}</h4>
                                <p>{{ __('messages.delete_question') }}</p>

                                <form
                                    method="POST"
                                    action="{{ route('appointments.destroy', $appointment->id) }}"
                                >
                                    @csrf
                                    @method ('DELETE')

                                    <button class="btn btn-danger">
                                        {{ __('messages.delete') }}
                                    </button>
                                </form>

                                <button
                                    class="btn btn-secondary mt-2"
                                    data-bs-dismiss="modal"
                                >
                                    {{ __('messages.cancel') }}
                                </button>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <h4>{{ __('messages.add_appointment') }}</h4>

                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf

                    <label>{{ __('messages.patient') }}</label>
                    <select name="patient_id" class="form-control">
                        <option value="" disabled selected>
                            ---- {{ __('messages.choose_patient') }} ----
                        </option>
                        @if (auth()->user()->role !== 'patient')
                            @foreach (\App\Models\User::where('role','patient')->get() as $patient)
                                <option value="{{ $patient->id }}">
                                    {{ $patient->first_name }} {{ $patient->last_name }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ auth()->user()->id }}" selected>
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </option>
                        @endif
                    </select>

                    <label>{{ __('messages.doctor') }}</label>
                    <select name="doctor_id" class="form-control">
                        <option value="" disabled selected>
                            ---- {{ __('messages.choose_doctor') }} ----
                        </option>
                        @if (auth()->user()->role !== 'doctor')
                            @foreach (\App\Models\User::where('role','doctor')->get() as $doctor)
                                <option value="{{ $doctor->id }}">
                                    {{ $doctor->first_name }} {{ $doctor->last_name }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ auth()->user()->id }}" selected>
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </option>
                        @endif
                    </select>

                    <label>{{ __('messages.service') }}</label>
                    <select name="service_id" class="form-control mt-2">
                        <option value="" disabled selected>
                            ---- {{ __('messages.choose_service') }} ----
                        </option>
                        @foreach (\App\Models\Service::all() as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>

                    <label>{{ __('messages.date') }}</label>
                    <input
                        type="datetime-local"
                        name="appointment_date"
                        class="form-control mt-2"
                    />

                    <label>{{ __('messages.status') }}</label>
                    <select name="status" class="form-control mt-2">
                        @if (auth()->user()->role !== 'patient')
                            <option value="" disabled selected>
                                ---- {{ __('messages.choose_status') }} ----
                            </option>
                            <option value="pending">
                                {{ __('messages.pending') }}
                            </option>
                            <option value="confirmed">
                                {{ __('messages.confirmed') }}
                            </option>
                            <option value="cancelled">
                                {{ __('messages.cancelled') }}
                            </option>
                        @else
                            <option value="" disabled selected>
                                ---- {{ __('messages.choose_status') }} ----
                            </option>
                            <option value="pending">
                                {{ __('messages.pending') }}
                            </option>
                        @endif
                    </select>

                    <button class="btn btn-primary mt-3">
                        {{ __('messages.create') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("search").addEventListener("keyup", function () {
            let query = this.value;

            axios
                .get("{{ route('search-appointments') }}", {
                    params: { q: query },
                })
                .then((response) => {
                    let rows = "";

                    response.data.forEach((app) => {
                        rows += `
                        <tr>
                            <td>${app.id}</td>
                            <td>${app.patient.first_name} ${app.patient.last_name}</td>
                            <td>${app.doctor.first_name} ${app.doctor.last_name}</td>
                            <td>${app.service.name}</td>
                            <td>${app.appointment_date}</td>
                            <td>${app.status}</td>
                            <td>
                            <button
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                            >
                                {{ __('messages.show') }}
                            </button>

                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                            >
                                {{ __('messages.edit') }}
                            </button>

                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                            >
                                {{ __('messages.delete') }}
                            </button>
                        </td>
                        </tr>
                    `;
                    });

                    document.getElementById("tableBody").innerHTML = rows;
                })
                .catch((error) => {
                    console.error(error);
                });
        });
    </script>
@endsection
