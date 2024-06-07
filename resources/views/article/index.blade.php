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
                        <td>
                            <a href="{{ route('article.show', $art) }}"><i class="bi bi-pen"></i></a>
                            <a id="delete{{ $art->id }}" class="text-danger"><i class="bi bi-trash3"></i></a>

                        </td>
                    </tr>
                    <script>
                        $("#delete{{ $art->id }}").on("click", (e) => {
                            if (confirm("Are you sure you want to delete this Article?")) {
                                axios.post("{{ route('article.delete', $art->id) }}")
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
