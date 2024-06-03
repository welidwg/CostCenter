@extends('layout')

@section('title', 'Home')
@php

    use App\Models\Demandeur;
    use App\Models\DemandeurAct;
    use App\Models\Article;
    use App\Models\Site;
    use App\Models\CycleProd;
    use Illuminate\Support\Facades\Request;
    $data = 'ECT';
    if (Request::get('type')) {
        $data = Request::get('type');
    }

    if (Auth::user()->role == 0) {
        $demandeurs = Auth::user()->type == 0 ? Demandeur::all() : DemandeurAct::all();
    } else {
        if ($data == 'ECT') {
            $demandeurs = Demandeur::all();
        } else {
            $demandeurs = DemandeurAct::all();
        }
    }
    $articles = Article::with('fonction')->orderBy('groupe', 'ASC')->get();
    $sites = Site::all();
    $cycles = CycleProd::all();
@endphp
@section('content')
    <div class="my-auto">
        <h1 class="text-primary text-center mb-5">COST CENTER</h1>
        @if (Auth::user()->role == 1)
            <div class="mb-3 col-md-4 mx-auto">
                <select class="form-select form-select-lg" id="select_type">
                    <option selected value="{{ $data }}">{{ $data }}</option>
                    @if ($data == 'ECT')
                        <option value="ACT">ACT</option>
                    @else
                        <option value="ECT">ECT</option>
                    @endif

                </select>
            </div>
            <script>
                $(document).ready(function() {
                    $("#select_type").on("change", (e) => {
                        let val = $("#select_type").val();
                        window.location.href = `/home?type=${val}`
                    })
                });
            </script>
        @endif


        <div class="row">

            <div class="col-md-6">
                <label class="mb-2 fw-bold fs-5" for="">
                    <span> Demandeur d'achat </span>


                    @if (Auth::user()->role == 1)
                        ({{ $data }})
                    @else
                        ({{ Auth::user()->type == 0 ? 'ECT' : 'ACT' }})
                    @endif
                </label>
                <select name="id_demandeur" id="id_demandeur" class="select-changement form-select form-select-lg">
                    @foreach ($demandeurs as $demandeur)
                        <option value="{{ $demandeur->id }}">{{ $demandeur->name }}</option>
                    @endforeach
                </select>
                <section class="w-100 mb-2 rounded p-3 ">
                    Matricule : <span id="matt"></span>
                    <br>
                    Département : <span id="dept"></span>
                </section>
            </div>
            <div class="col-md-6">
                <label class="mb-2 fw-bold fs-5" for="">Choix d'article</label>
                <select name="id_article" id="id_article" class="select-changement form-select form-select-lg">
                    @foreach ($articles as $article)
                        <option value="{{ $article->id }}">{{ $article->designation_court }}</option>
                    @endforeach
                </select>
                <section class=" mb-2 w-100 rounded p-3 ">
                    Fonction : <span id="fct"></span>
                    <br>
                    Groupe Article : <span id="grp"></span>
                </section>
            </div>
            <div class="col-md-6">
                <label class="mb-2 fw-bold fs-5" for="">Choix de site</label>
                <select name="id_site" id="id_site" class="select-changement form-select form-select-lg mb-3">
                    @foreach ($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->code }} | {{ $site->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="mb-2 fw-bold fs-5" for="">Choix de cycle de production</label>

                <select name="id_cycle" id="id_cycle" class="select-changement form-select form-select-lg mb-3">
                    @foreach ($cycles as $cycle)
                        <option value="{{ $cycle->id }}">{{ $cycle->code }} | {{ $cycle->description }}</option>
                    @endforeach
                </select>
            </div>



        </div>

        <div class="mx-auto text-center mt-3 mb-3 p-4 rounded bg-white col-md-6">
            <label class=" fs-4 text-center text-dark">Compte : <span class="fw-bold text-success"
                    id="compte"></span></label>
        </div>
        <script>
            function envoyerRequete() {
                let data = {
                    "id_demandeur": parseInt($("#id_demandeur").val()),
                    "id_article": parseInt($("#id_article").val()),
                    "id_site": parseInt($("#id_site").val()),
                    "id_cycle": parseInt($("#id_cycle").val())
                };

                axios.post("/compte", data, {
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(res => {
                        $("#compte").html("")
                        $("#dept").html("")
                        $("#fct").html("")
                        $("#grp").html("")
                        $("#matt").html("")
                        $("#compte").html(res.data.compte)
                        $("#dept").html(
                            `<strong>${res.data.demandeur.departement.code}</strong> | ${res.data.demandeur.departement.description}`
                        )
                        $("#fct").html(
                            `<strong>${res.data.article.fonction.fonction}</strong> | ${res.data.article.fonction.description}`
                        )
                        $("#grp").html(
                            `${res.data.article.groupe}`)
                        $("#matt").html(
                            `${res.data.demandeur.matricule}`)
                    })
                    .catch(err => {
                        console.error(err.response.data);
                    });

            }
            $(".select-changement").on("change", (e) => {
                envoyerRequete();
            })
            $(document).ready(function() {
                envoyerRequete();
                $("#id_demandeur").select2({
                    theme: 'bootstrap-5'
                });
                $("#id_site").select2({
                    theme: 'bootstrap-5'
                });
                $("#id_article").select2({
                    theme: 'bootstrap-5'
                });
                $("#id_cycle").select2({
                    theme: 'bootstrap-5'
                });
            });
        </script>
    </div>
@endsection
