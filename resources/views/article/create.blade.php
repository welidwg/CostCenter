@extends('layout')

@section('title', 'Article')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('article.index') }}"><i
                class="bi bi-arrow-left"></i></a>
        Add
        Department </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Groupe</label>
            <input type="text" class="form-control" id="groupe">
        </div>
        <div class="mb-3">
            <label class="form-label">Désignation court</label>
            <input type="text" class="form-control" id="des_c">
        </div>
        <div class="mb-3">
            <label class="form-label">Désignation long</label>
            <input type="text" class="form-control" id="des_l">

        </div>
        <div class="mb-3">
            <label class="form-label">Fonction</label>
            <select name="id_fct" id="id_fct" class="form-select form-select-lg mb-3">
                @foreach ($fcts as $fct)
                    <option value="{{ $fct->id }}">{{ $fct->fonction }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100" id="submit">Add</button>
        <script>
            $(document).ready(function() {
                $("#id_fct").select2({
                    theme: "bootstrap-5"
                })
            });
            $("#submit").on("click", (e) => {
                let data = {
                    "groupe": $("#groupe").val(),
                    "designation_long": $("#des_l").val(),
                    "designation_court": $("#des_c").val(),
                    "id_fonction": $("#id_fct").val(),
                }
                axios.post("/article", data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        console.log(res)
                        window.location.href = `{{ route('article.index') }}`
                    })
                    .catch(err => {
                        console.error(err);
                    })
            })
        </script>
    </div>
@endsection
