@extends('layout')

@section('title', 'Demandeurs')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">Demandeurs d'achat <a href="{{ route('demandeur.create') }}"><i
                class="bi bi-plus-circle"></i>
        </a></h1>
    <div class="col-md-8 mx-auto">
        <table class="table table-striped col-md-8" id="table">
            <thead>
                <tr>
                    <th scope="col">Matricule</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="">Fonction</th>
                    <th scope="">Site</th>
                    <th scope="">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dms as $dm)
                    <tr>
                        <th scope="row">{{ $dm->matricule }}</th>
                        <td>{{ $dm->name }}</td>
                        <td>{{ $dm->departement->abt }}</td>
                        <td>{{ $dm->fonction->fonction }}</td>
                        <td>{{ $dm->site->description }}</td>
                        <td>--</td>
                    </tr>
                @empty
                    <td>

                    </td>
                    <td></td>
                    <td>No demandeur found</td>
                    <td></td>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        new DataTable('#table');
    </script>

@endsection
