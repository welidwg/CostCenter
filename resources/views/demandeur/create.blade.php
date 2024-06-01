@extends('layout')

@section('title', 'Demandeur')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('demandeur.index') }}"><i
                class="bi bi-arrow-left"></i></a>
        Add
        Demandeur </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Matricule</label>
            <input type="text" class="form-control" id="mat">
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="dept" id="dept" class="form-select form-select-lg mb-3">
                @foreach ($depts as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->abt }} | {{ $dept->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Site</label>
            <select name="site" id="site" class="form-select form-select-lg mb-3">
                @foreach ($sites as $site)
                    <option value="{{ $site->id }}"> {{ $site->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Fonction</label>
            <select name="fct" id="fct" class="form-select form-select-lg mb-3">
                @foreach ($fcts as $fct)
                    <option value="{{ $fct->id }}"> {{ $fct->fonction }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Groupe article</label>
            <select name="grp" id="grp" class="form-select form-select-lg mb-3">
                @foreach ($articles as $art)
                    <option value="{{ $art->groupe }}"> {{ $art->groupe }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100" id="submit">Add</button>
        <script>
            $("#submit").on("click", (e) => {
                let data = {
                    "matricule": $("#mat").val(),
                    "name": $("#name").val(),
                    "id_departement": $("#dept").val(),
                    "id_site": $("#site").val(),
                    "id_fonction": $("#fct").val(),
                    "groupe_article": $("#grp").val()
                }
                axios.post("/demandeur", data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        console.log(res)
                        window.location.href = `{{ route('demandeur.index') }}`
                    })
                    .catch(err => {
                        console.error(err);
                    })
            })
            $(document).ready(function() {
                $("#fct").select2({
                    theme: "bootstrap-5"
                });

                $("#site").select2({
                    theme: "bootstrap-5"
                });

                $("#dept").select2({
                    theme: "bootstrap-5"
                });

                $("#grp").select2({
                    theme: "bootstrap-5"
                });
            });
        </script>
    </div>
@endsection
