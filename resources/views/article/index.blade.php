@extends('layout')

@section('title', 'Articles')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4">Articles <a href="{{ route('article.create') }}"><i
                class="bi bi-plus-circle"></i>
        </a></h1>
    <div class="col-md-12 mx-auto table-responsive">
        <table class="table table-striped col-md-8" id="table">
            <thead>
                <tr>
                    <th scope="col">Groupe</th>
                    <th scope="col">Désignation- Groupe d'articles - texte Court</th>
                    <th scope="col">Désignation- Groupe d'articles - texte Long</th>
                    <th scope="">Fonction</th>
                    <th scope="">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $art)
                    <tr>
                        <th scope="row">{{ $art->groupe }}</th>
                        <td>{{ $art->designation_court }}</td>
                        <td>{{ $art->designation_long }}</td>
                        <td>{{ $art->fonction->fonction }}</td>
                        <td>--</td>
                    </tr>
                @empty
                    <td>

                    </td>
                    <td></td>
                    <td>No articles found</td>
                    <td></td>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        new DataTable('#table');
    </script>

@endsection
