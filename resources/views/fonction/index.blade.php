@extends('layout')

@section('title', 'Fonction')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">Fonctions <a href="{{ route('fonction.create') }}"><i
                class="bi bi-plus-circle"></i>
        </a></h1>
    <div class="col-md-6 mx-auto table-responsive">
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="">Code</th>
                    <th scope="">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fonctions as $fct)
                    <tr>
                        <th scope="row">{{ $fct->fonction }}</th>
                        <td>{{ $fct->description }}</td>
                        <td>{{ $fct->code }}</td>
                        <td> <a href="{{ route('fonction.show', $fct) }}"><i class="bi bi-pen"></i></a>
                            <a id="delete{{ $fct->id }}" class="text-danger"><i class="bi bi-trash3"></i></a>

                        </td>
                    </tr>
                    <script>
                        $("#delete{{ $fct->id }}").on("click", (e) => {
                            if (confirm("Are you sure you want to delete this fonction ?")) {
                                axios.post("{{ route('fonction.delete', $fct->id) }}")
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
                    <td>No fonctions found</td>
                    <td></td>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        new DataTable("#table")
    </script>


@endsection
