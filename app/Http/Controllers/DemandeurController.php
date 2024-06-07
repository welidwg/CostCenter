<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Demandeur;
use App\Models\Departement;
use App\Models\Fonction;
use App\Models\Site;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;

class DemandeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dms = Demandeur::with("site", "fonction", "departement")->get();
        return view("demandeur/index", compact("dms"));
    }
    function addData(Request $request)
    {
        try {
            $dept = Departement::where("code", $request->departement)->first();
            $site = Site::where("code", $request->site)->first();
            $fun = Fonction::where("fonction", $request->fonction)->first();

            $data = $request->all();
            $data["id_fonction"] = $fun->id;
            $data["id_site"] = $site->id;
            $data["id_departement"] = $dept->id;
            // $data["id_article"] = $article->id;
            Demandeur::create($data);
            return response(json_encode(["success" => 1, "message" => "Bien crée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["success" => 0, "message" => $th->getMessage()]), 200);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fcts = Fonction::all();
        $sites = Site::all();
        $depts = Departement::all();
        $articles = Article::all();
        return view("demandeur/create", compact("fcts", "sites", "depts", "articles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Demandeur::create($request->all());
            return response(json_encode(["success" => 1, "message" => "Bien crée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["success" => 0, "message" => $th->getMessage()]), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demandeur  $demandeur
     * @return \Illuminate\Http\Response
     */
    public function show(Demandeur $demandeur)
    {
        $fcts = Fonction::where("id", "!=", $demandeur->id_fonction)->get();
        $sites = Site::where("id", "!=", $demandeur->id_site)->get();
        $depts = Departement::where("id", "!=", $demandeur->id_departement)->get();
        $articles = Article::where("groupe", "!=", $demandeur->groupe_article)->get();
        return view("demandeur/show", compact("articles", "fcts", "sites", "depts", "demandeur"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demandeur  $demandeur
     * @return \Illuminate\Http\Response
     */
    public function edit(Demandeur $demandeur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demandeur  $demandeur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demandeur $demandeur)
    {
        try {
            $data = $request->all();
            $demandeur->update($data);
            return response(json_encode(["success" => 1, "message" => "Updated"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demandeur  $demandeur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demandeur $demandeur)
    {
        try {
            $demandeur->delete();
            return response(json_encode(["success" => 1, "message" => "Deleted"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    function delete($id)
    {
        try {
            $demandeur = Demandeur::find($id);
            $demandeur->delete();
            return response(json_encode(["success" => 1, "message" => "Deleted"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
