@extends('layout')

@section('title', 'Demandeurs Act')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">Demandeurs d'achat ACT <a href="{{ route('demandeurAct.create') }}"><i
                class="bi bi-plus-circle"></i>
        </a></h1>
    <div class="col-md-12 mx-auto table-responsive">
        <table class="table table-striped col-12 " id="table">
            <thead>
                <tr>
                    <th scope="col">Matricule</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="">Fonction</th>
                    <th scope="">Groupe article</th>
                    <th scope="">Action</th>
                </tr>
            </thead>
            <tbody>



                @foreach ($dms as $dm)
                    <tr>
                        <th scope="row">{{ $dm->matricule }}</th>
                        <td>{{ $dm->name }}</td>
                        <td>{{ $dm->departement->code }} | {{ $dm->departement->description }}</td>
                        <td>{{ $dm->fonction->fonction }}</td>
                        <td>{{ $dm->groupe_article }}</td>
                        <td>--</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $('#table').DataTable();
    </script>

@endsection
