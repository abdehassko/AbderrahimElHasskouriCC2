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
            Add
        </button>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Account status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody id="tableBody">
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->is_active ===1 ? "Active" : "Not active"}}
                        </td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <button
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#show{{ $user->id }}"
                            >
                                Show
                            </button>

                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#edit{{ $user->id }}"
                            >
                                Edit
                            </button>

                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#delete{{ $user->id }}"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                    <!-- SHOW MODAL -->
                    <div class="modal fade" id="show{{ $user->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>User Details</h4>
                                <p><b>First name :</b> {{ $user->first_name }}</p>
                                <p><b>Last name :</b> {{ $user->last_name }}</p>
                                <p><b>Email :</b> {{ $user->email }}</p>
                                <p><b>Account status :</b> {{$user->is_active===1 ? "Active" : "Not active"}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- EDIT MODAL -->
                    <div class="modal fade" id="edit{{ $user->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <form
                                    method="POST"
                                    action="{{ route('users.update', $user->id) }}"
                                >
                                    @csrf
                                    <input
                                        type="hidden"
                                        name="_method"
                                        value="PUT"
                                    />

                                    <input
                                        type="text"
                                        name="first_name"
                                        value="{{ $user->first_name }}"
                                        class="form-control"
                                    />
                                    <input
                                        type="text"
                                        name="last_name"
                                        value="{{ $user->last_name }}"
                                        class="form-control mt-2"
                                    />
                                    <input
                                        type="email"
                                        name="email"
                                        value="{{ $user->email }}"
                                        class="form-control mt-2"
                                    />
                                    <select
                                        name="is_active"
                                        class="form-control mt-2"
                                    >
                                        <option
                                            value="1"
                                            {{ $user->is_active===1 ? 'selected' : '' }}
                                        >
                                            Activated
                                        </option>
                                        <option
                                            value="0"
                                            {{ $user->is_active===0 ? 'selected' : '' }}
                                        >
                                            Desactivated
                                        </option>
                                    </select>

                                    <button class="btn btn-success mt-3">
                                        Update
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- DELETE MODAL -->
                    <div class="modal fade" id="delete{{ $user->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <form
                                    method="POST"
                                    action="{{ route('users.destroy', $user->id) }}"
                                >
                                    @csrf
                                    @method ('DELETE')

                                    <p>Are you sure?</p>
                                    <button class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>
    <!-- CREATE MODAL -->
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <input
                        type="text"
                        name="first_name"
                        placeholder="First Name"
                        class="form-control"
                    />
                    <input
                        type="text"
                        name="last_name"
                        placeholder="Last Name"
                        class="form-control mt-2"
                    />
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        class="form-control mt-2"
                    />
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="form-control mt-2"
                    />

                    <input
                        type="hidden"
                        name="role"
                        value="{{ request()->routeIs('patients.*') ? 'patient' : 'doctor' }}"
                    />

                    <button class="btn btn-primary mt-3">Create</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let searchInput = document.getElementById("search");

            if (!searchInput) {
                console.log("Search input not found");
                return;
            }

            let role = "{{ request()->routeIs('patients.*') ? 'patient' : 'doctor' }}";

            console.log("ROLE:", role);

            searchInput.addEventListener("keyup", function () {
                let query = this.value;

                console.log("Searching:", query);

                axios
                    .get("{{ route('search-users') }}", {
                        params: { q: query, role: role },
                    })
                    .then((response) => {
                        console.log("RESULT:", response.data);

                        let rows = "";

                        response.data.forEach((user) => {
                            rows += `
                            <tr>
                                <td>${user.id}</td>
                                <td>${user.first_name}</td>
                                <td>${user.last_name}</td>
                                <td>${user.email}</td>
                                <td>${user.is_active ? "Active" : "Inactive"}</td>
                                <td>${user.role}</td>
                                <td>
                            <button
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#show{{ $user->id }}"
                            >
                                Show
                            </button>

                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#edit{{ $user->id }}"
                            >
                                Edit
                            </button>

                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#delete{{ $user->id }}"
                            >
                                Delete
                            </button>
                        </td>
                            </tr>
                        `;
                        });

                        document.getElementById("tableBody").innerHTML = rows;
                    })
                    .catch((error) => {
                        console.error("ERROR:", error);
                    });
            });
        });
    </script>

@endsection
