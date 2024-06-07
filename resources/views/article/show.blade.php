@extends('layout')

@section('title', 'Edit Article')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('article.index') }}"><i
                class="bi bi-arrow-left"></i></a>
        Edit Article </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Groupe</label>
            <input type="text" class="form-control" id="groupe" value="{{ $article->groupe }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Désignation court</label>
            <input type="text" class="form-control" id="des_c" value="{{ $article->designation_court }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Désignation long</label>
            <input type="text" class="form-control" id="des_l" value="{{ $article->designation_long }}">

        </div>
        <div class="mb-3">
            <label class="form-label">Fonction</label>
            <select name="id_fct" id="id_fct" class="form-select form-select-lg mb-3">
                <option value="{{ $article->id_fonction }}">{{ $article->fonction->fonction }}</option>
                @foreach ($fcts as $fct)
                    <option value="{{ $fct->id }}">{{ $fct->fonction }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3" id="submit">Save</button>
        <div class="infos">

        </div>
        <script>
            $(document).ready(function() {
                $("#id_fct").select2({
                    theme: "bootstrap-5"
                })
            });
            $("#submit").on("click", (e) => {
                $(".infos").html(``)
                let data = {
                    "groupe": $("#groupe").val(),
                    "designation_long": $("#des_l").val(),
                    "designation_court": $("#des_c").val(),
                    "id_fonction": $("#id_fct").val(),
                }
                axios.put("{{ route('article.update', $article) }}", data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        console.log(res)
                        $(".infos").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Updated ! </strong>
            </div>`)
                        setTimeout(() => {
                            window.location.href = `{{ route('article.index') }}`
                        }, 1400);
                    })
                    .catch(err => {
                        console.error(err);
                        $(".infos").html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Server Error ! </strong>
            </div>`)
                    })
            })
        </script>
    </div>
@endsection
