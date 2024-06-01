@extends('layout')

@section('title', 'Departments')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">Departments <a href="{{ route('departement.create') }}"><i
                class="bi bi-plus-circle"></i>
        </a></h1>
    <div class="col-md-6  mx-auto table-responsive">
        <table class="table table-striped">
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
                        <td>--</td>
                    </tr>
                @empty
                    <td>

                    </td>
                    <td></td>
                    <td>No departments found</td>
                    <td></td>
                @endforelse
            </tbody>
        </table>
    </div>


@endsection
