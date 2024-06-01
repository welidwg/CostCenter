@extends('layout')

@section('title', 'Fonction')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">Fonctions <a href="{{ route('fonction.create') }}"><i
                class="bi bi-plus-circle"></i>
        </a></h1>
    <div class="col-md-6 mx-auto">
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
                        <td>--</td>
                    </tr>
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
