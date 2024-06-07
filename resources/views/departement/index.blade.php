@extends('layout')

@section('title', 'Departments')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">Departments <a href="{{ route('departement.create') }}"><i
                class="bi bi-plus-circle"></i>
        </a></h1>
    <div class="col-md-6  mx-auto table-responsive">
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Abt</th>
                    <th scope="col">Description</th>
                    <th scope="">Code</th>
                    <th scope="">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($departements as $dept)
                    <tr>
                        <th scope="row">{{ $dept->id }}</th>
                        <td>{{ $dept->abt }}</td>
                        <td>{{ $dept->description }}</td>
                        <td>{{ $dept->code }}</td>
                        <td> <a href="{{ route('departement.show', $dept) }}"><i class="bi bi-pen"></i></a>
                            <a id="delete{{ $dept->id }}" class="text-danger"><i class="bi bi-trash3"></i></a>

                        </td>
                    </tr>
                    <script>
                        $("#delete{{ $dept->id }}").on("click", (e) => {
                            if (confirm("Are you sure you want to delete this departement ?")) {
                                axios.post("{{ route('departement.delete', $dept->id) }}")
                                    .then(res => {
                                        console.log(res)
                                        window.location.reload();
                                    })
                                    .catch(err => {
                                        console.error(err.response.data);
                                    })
                            }
                        })
                    </script>
                @empty
                    <td>

                    </td>
                    <td></td>
                    <td>No departments found</td>
                    <td></td>
                @endforelse
            </tbody>
        </table>
        <script>
            $("#table").DataTable({
                theme: "bootstrap-5"
            })
        </script>
    </div>


@endsection
