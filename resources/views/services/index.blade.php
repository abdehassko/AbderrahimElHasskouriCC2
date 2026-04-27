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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.price') }}</th>
                    <th>{{ __('messages.category') }}</th>
                    <th>{{ __('messages.description') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>

            <tbody id="tableBody">
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->price }}</td>
                        <td>{{ $service->category }}</td>
                        <td>{{ $service->description }}</td>

                        <td>
                            <button
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#showModal{{ $service->id }}"
                            >
                                {{ __('messages.show') }}
                            </button>

                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $service->id }}"
                            >
                                {{ __('messages.edit') }}
                            </button>

                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $service->id }}"
                            >
                                {{ __('messages.delete') }}
                            </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="showModal{{ $service->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>{{ __('messages.service_details') }}</h4>

                                <p><b>Name:</b> {{ $service->name }}</p>
                                <p><b>Price:</b> {{ $service->price }}</p>
                                <p><b>Category:</b> {{ $service->category }}</p>
                                <p><b>Description:</b> {{ $service->description }}</p>

                                <button
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    {{ __('messages.close') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editModal{{ $service->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>{{ __('messages.edit_service') }}</h4>

                                <form
                                    method="POST"
                                    action="{{ route('services.update', $service->id) }}"
                                >
                                    @csrf
                                    @method ('PUT')

                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ $service->name }}"
                                        class="form-control"
                                    />

                                    <input
                                        type="number"
                                        name="price"
                                        value="{{ $service->price }}"
                                        class="form-control mt-2"
                                    />

                                    <select
                                        name="category"
                                        class="form-control mt-2"
                                    >
                                        @foreach (\App\Models\Service::CATEGORIES as $value => $label)
                                            <option value="{{ $value }}">
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <textarea
                                        name="description"
                                        class="form-control mt-2"
                                        >{{ $service->description }}</textarea
                                    >

                                    <button class="btn btn-success mt-3">
                                        {{ __('messages.update') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- 🗑 DELETE -->
                    <div class="modal fade" id="deleteModal{{ $service->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <h4>{{ __('messages.confirm_delete') }}</h4>
                                <p>{{ __('messages.delete_question') }}</p>

                                <form
                                    method="POST"
                                    action="{{ route('services.destroy', $service->id) }}"
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
                <h4>{{ __('messages.add_service') }}</h4>

                <form method="POST" action="{{ route('services.store') }}">
                    @csrf

                    <input
                        type="text"
                        name="name"
                        placeholder="Name"
                        class="form-control"
                    />

                    <input
                        type="number"
                        name="price"
                        placeholder="Price"
                        class="form-control mt-2"
                    />

                    <select name="category" class="form-control mt-2">
                        @foreach (\App\Models\Service::CATEGORIES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                    <textarea
                        name="description"
                        placeholder="Description"
                        class="form-control mt-2"
                    ></textarea>

                    <button class="btn btn-primary mt-3">
                        {{ __('messages.create') }}
                    </button>
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

            searchInput.addEventListener("keyup", function () {
                let query = this.value;

                console.log("Searching:", query);

                axios
                    .get("{{ route('search-services') }}", {
                        params: { q: query },
                    })
                    .then((response) => {
                        console.log("RESULT:", response.data);

                        let rows = "";

                        response.data.forEach((service) => {
                            rows += `
                            <tr>
                                <td>${service.id}</td>
                                <td>${service.name}</td>
                                <td>${service.price}</td>
                                <td>${service.category}</td>
                                <td>${service.description ? "Active" : "Inactive"}</td>
                                <td>
                            <button
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#show{{ $service->id }}"
                            >
                                Show
                            </button>

                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#edit{{ $service->id }}"
                            >
                                Edit
                            </button>

                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#delete{{ $service->id }}"
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
