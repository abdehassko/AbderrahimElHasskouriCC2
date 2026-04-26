@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h2>{{ __('messages.appointments') }}</h2>

        <!-- 🔍 SEARCH -->
        <input
            type="text"
            id="search"
            class="form-control mb-3"
            placeholder="Search by anything..."
        />

        <!-- ➕ ADD BUTTON -->
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

        <!-- 📋 TABLE -->
        <table class="table table-bordered" id="appointmentsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                        <td>{{ $appointment->status }}</td>
                        <td>
                            <!-- 👁 SHOW -->
                            <button
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#showModal{{ $appointment->id }}"
                            >
                                Show
                            </button>

                            <!-- ✏ EDIT -->
                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $appointment->id }}"
                            >
                                Edit
                            </button>

                            <!-- 🗑 DELETE -->
                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $appointment->id }}"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                    <!-- ================= SHOW MODAL ================= -->
                    <div
                        class="modal fade"
                        id="showModal{{ $appointment->id }}"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>Appointment Details</h4>

                                <p><b>Patient:</b> {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>
                                <p><b>Doctor:</b> {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</p>
                                <p><b>Service:</b> {{ $appointment->service->name }}</p>
                                <p><b>Date:</b> {{ $appointment->appointment_date }}</p>
                                <p><b>Status:</b> {{ $appointment->status }}</p>

                                <button
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ================= EDIT MODAL ================= -->
                    <div
                        class="modal fade"
                        id="editModal{{ $appointment->id }}"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>Edit Appointment</h4>

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

                                    <label>Patient</label>
                                    <select
                                        name="patient_id"
                                        class="form-control"
                                    >
                                        @foreach (\App\Models\User::where('role','patient')->get() as $patient)
                                            <option
                                                value="{{ $patient->id }}"
                                                {{ $patient->id ==  $appointment->patient_id
                                                ?
                                                'selected'
                                                :
                                                ''
                                                }}
                                            >
                                                {{ $patient->first_name }} {{ $patient->last_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <label>Doctor</label>

                                    <select
                                        name="doctor_id"
                                        class="form-control"
                                    >
                                        @foreach (\App\Models\User::where('role','doctor')->get() as $doctor)
                                            <option
                                                value="{{ $doctor->id }}"
                                                {{ $doctor->id ==  $appointment->doctor_id
                                                ?
                                                'selected'
                                                :
                                                ''
                                                }}
                                            >
                                                {{ $doctor->first_name }} {{ $doctor->last_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <label>Service</label>
                                    <select
                                        name="service_id"
                                        class="form-control mt-2"
                                    >
                                        @foreach (\App\Models\Service::all() as $service)
                                            <option
                                                value="{{ $service->id }}"
                                                {{ $service->id ==  $appointment->service_id
                                                ?
                                                'selected'
                                                :
                                                ''
                                                }}
                                            >
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <label>Date</label>
                                    <input
                                        type="datetime-local"
                                        name="appointment_date"
                                        class="form-control"
                                        value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i') }}"
                                    />

                                    <label>Status</label>
                                    <select
                                        name="status"
                                        class="form-control mt-2"
                                    >
                                        <option
                                            value="pending"
                                            {{ $appointment->status == 'pending' ? 'selected' : '' }}
                                            >Pending
                                        </option>
                                        <option
                                            value="confirmed"
                                            {{ $appointment->status == 'confirmed' ? 'selected' : '' }}
                                            >Confirmed
                                        </option>
                                        <option
                                            value="cancelled"
                                            {{ $appointment->status == 'cancelled' ? 'selected' : '' }}
                                            >Cancelled
                                        </option>
                                    </select>

                                    <button
                                        type="submit"
                                        class="btn btn-success mt-3"
                                    >
                                        Update
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ================= DELETE MODAL ================= -->
                    <div
                        class="modal fade"
                        id="deleteModal{{ $appointment->id }}"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>Confirm Delete</h4>
                                <p>Are you sure you want to delete this appointment?</p>

                                <form
                                    method="POST"
                                    action="{{ route('appointments.destroy', $appointment->id) }}"
                                >
                                    @csrf
                                    @method ('DELETE')

                                    <button class="btn btn-danger">
                                        Yes, Delete
                                    </button>
                                </form>

                                <button
                                    class="btn btn-secondary mt-2"
                                    data-bs-dismiss="modal"
                                >
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>
    <!-- ================= CREATE MODAL ================= -->
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <h4>Add Appointment</h4>

                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf

                    <label>Patient</label>
                    <select name="patient_id" class="form-control">
                        <option value="" disabled selected>
                            ---- Choose patient ----
                        </option>
                        @foreach (\App\Models\User::where('role','doctor')->get() as $patient)
                            <option value="{{ $patient->id }}">
                                {{ $patient->first_name }} {{ $patient->first_name }}
                            </option>
                        @endforeach
                    </select>

                    <label>Doctor</label>
                    <select name="doctor_id" class="form-control">
                        <option value="" disabled selected>
                            ---- Choose doctor ----
                        </option>
                        @foreach (\App\Models\User::where('role','doctor')->get() as $doctor)
                            <option value="{{ $doctor->id }}">
                                {{ $doctor->first_name }} {{ $doctor->last_name }}
                            </option>
                        @endforeach
                    </select>

                    <label>Service</label>
                    <select name="service_id" class="form-control mt-2">
                        <option value="" disabled selected>
                            ---- Choose service ----
                        </option>
                        @foreach (\App\Models\Service::all() as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>

                    <label>Date</label>
                    <input
                        type="datetime-local"
                        name="appointment_date"
                        class="form-control mt-2"
                    />

                    <label>Status</label>
                    <select name="status" class="form-control mt-2">
                        <option value="" disabled selected>
                            ---- Choose status ----
                        </option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>

                    <button class="btn btn-primary mt-3">Create</button>
                </form>
            </div>
        </div>
    </div>
    <!-- ================= AXIOS SEARCH ================= -->
    <script>
        document.getElementById("search").addEventListener("input", function () {
            let query = this.value;

            axios.get("/search-appointments?q=" + query).then((res) => {
                let rows = "";

                res.data.forEach((a) => {
                    rows += `
                        <tr>
                            <td>${a.id}</td>
                            <td>${a.patient.first_name} ${a.patient.last_name}</td>
                            <td>${a.doctor.first_name} ${a.doctor.last_name}</td>
                            <td>${a.service.name}</td>
                            <td>${a.appointment_date}</td>
                            <td>${a.status}</td>
                            <td>

                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showModal{{ $appointment->id }}">
                                Show
                            </button>

                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $appointment->id }}">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $appointment->id }}">
                                Delete
                            </button>

                        </td>
                        </tr>
                    `;
                });

                document.getElementById("tableBody").innerHTML = rows;
            });
        });
    </script>

@endsection
