@extends('layouts.app')

@section('content')

<div class="container">

    <h2>{{ __('messages.appointments') }}</h2>

    <!-- 🔍 SEARCH -->
    <input type="text" id="search" class="form-control mb-3" placeholder="Search by date...">

    <!-- ➕ ADD BUTTON -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        {{ __('messages.add') }}
    </button>

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
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                <td>{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</td>
                <td>{{ $appointment->service->name }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->status }}</td>
                <td>

                    <!-- 👁 SHOW -->
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showModal{{ $appointment->id }}">
                        Show
                    </button>

                    <!-- ✏ EDIT -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $appointment->id }}">
                        Edit
                    </button>

                    <!-- 🗑 DELETE -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $appointment->id }}">
                        Delete
                    </button>

                </td>
            </tr>

            <!-- ================= SHOW MODAL ================= -->
            <div class="modal fade" id="showModal{{ $appointment->id }}">
                <div class="modal-dialog">
                    <div class="modal-content p-3">
                        <h4>Appointment Details</h4>

                        <p><b>Patient:</b> {{ $appointment->patient->name }}</p>
                        <p><b>Doctor:</b> {{ $appointment->doctor->name }}</p>
                        <p><b>Service:</b> {{ $appointment->service->name }}</p>
                        <p><b>Date:</b> {{ $appointment->appointment_date }}</p>
                        <p><b>Status:</b> {{ $appointment->status }}</p>

                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

            <!-- ================= EDIT MODAL ================= -->
            <div class="modal fade" id="editModal{{ $appointment->id }}">
                <div class="modal-dialog">
                    <div class="modal-content p-3">

                        <h4>Edit Appointment</h4>

                        <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
                            @csrf
                            @method('PUT')

                            <label>Date</label>
                            <input type="datetime-local" name="appointment_date" class="form-control"
                                value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i') }}">

                            <label>Status</label>
                            <select name="status" class="form-control mt-2">
                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>

                            <button class="btn btn-success mt-3">Update</button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- ================= DELETE MODAL ================= -->
            <div class="modal fade" id="deleteModal{{ $appointment->id }}">
                <div class="modal-dialog">
                    <div class="modal-content p-3">

                        <h4>Confirm Delete</h4>
                        <p>Are you sure you want to delete this appointment?</p>

                        <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger">Yes, Delete</button>
                        </form>

                        <button class="btn btn-secondary mt-2" data-bs-dismiss="modal">Cancel</button>

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

                <label>Doctor</label>
                <select name="doctor_id" class="form-control">
                    @foreach(\App\Models\User::where('role','doctor')->get() as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>

                <label>Service</label>
                <select name="service_id" class="form-control mt-2">
                    @foreach(\App\Models\Service::all() as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>

                <label>Date</label>
                <input type="datetime-local" name="appointment_date" class="form-control mt-2">

                <button class="btn btn-primary mt-3">Create</button>
            </form>

        </div>
    </div>
</div>

<!-- ================= AXIOS SEARCH ================= -->
<script>
document.getElementById('search').addEventListener('input', function () {
    let query = this.value;

    axios.get('/search-appointments?q=' + query)
    .then(res => {
        let rows = '';

        res.data.forEach(a => {
            rows += `
                <tr>
                    <td>${a.id}</td>
                    <td>${a.patient_id}</td>
                    <td>${a.doctor_id}</td>
                    <td>${a.service_id}</td>
                    <td>${a.appointment_date}</td>
                    <td>${a.status}</td>
                    <td>...</td>
                </tr>
            `;
        });

        document.getElementById('tableBody').innerHTML = rows;
    });
});
</script>

@endsection