@extends('layout')

@section('title', 'Demandeur ECT')

@section('content')
    <h1 class="text-primary text-center  mb-3 fs-4"> <a href="{{ route('demandeur.index') }}"><i
                class="bi bi-arrow-left"></i></a>
        Edit
        Demandeur ECT </h1>
    <div class="mx-auto col-md-6">
        <div class="mb-3">
            <label class="form-label">Matricule</label>
            <input type="text" class="form-control" id="mat" value="{{ $demandeur->matricule }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" id="name" value="{{ $demandeur->name }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="dept" id="dept" class="form-select form-select-lg mb-3">
                <option value="{{ $demandeur->id_departement }}">{{ $demandeur->departement->abt }} |
                    {{ $demandeur->departement->description }}</option>
                @foreach ($depts as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->abt }} | {{ $dept->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Site</label>
            <select name="site" id="site" class="form-select form-select-lg mb-3">
                <option value="{{ $demandeur->id_site }}">{{ $demandeur->site->description }} </option>
                @foreach ($sites as $site)
                    <option value="{{ $site->id }}"> {{ $site->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Fonction</label>
            <select name="fct" id="fct" class="form-select form-select-lg mb-3">
                <option value="{{ $demandeur->id_fonction }}">{{ $demandeur->fonction->fonction }} </option>
                @foreach ($fcts as $fct)
                    <option value="{{ $fct->id }}"> {{ $fct->fonction }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Groupe article</label>
            <select name="grp" id="grp" class="form-select form-select-lg mb-3">
                <option value="{{ $demandeur->groupe_article }}">{{ $demandeur->groupe_article }}</option>
                <option value="all">All</option>
                @foreach ($articles as $art)
                    <option value="{{ $art->groupe }}"> {{ $art->groupe }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3" id="submit">Save</button>

        <div class="infos"></div>
        <script>
            $("#submit").on("click", (e) => {
                $(".infos").html(``)
                let data = {
                    "matricule": $("#mat").val(),
                    "name": $("#name").val(),
                    "id_departement": $("#dept").val(),
                    "id_site": $("#site").val(),
                    "id_fonction": $("#fct").val(),
                    "groupe_article": $("#grp").val()
                }
                axios.put("{{ route('demandeur.update', $demandeur) }}", data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        $(".infos").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Updated ! </strong>
            </div>`)
                        setTimeout(() => {
                            window.location.href = `{{ route('demandeur.index') }}`
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
