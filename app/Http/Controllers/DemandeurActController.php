<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\DemandeurAct;
use App\Models\Departement;
use App\Models\Fonction;
use Illuminate\Http\Request;

class DemandeurActController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dms = DemandeurAct::with("fonction", "departement")->get();
        return view("demandeurAct/index", compact("dms"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fcts = Fonction::all();
        $depts = Departement::all();
        $articles = Article::all();
        return view("demandeurAct/create", compact("fcts", "depts", "articles"));
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
            DemandeurAct::create($request->all());
            return response(json_encode(["success" => 1, "message" => "Bien crée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["success" => 0, "message" => $th->getMessage()]), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DemandeurAct  $demandeurAct
     * @return \Illuminate\Http\Response
     */
    public function show(DemandeurAct $demandeurAct)
    {
        $demandeur = $demandeurAct;
        $fcts = Fonction::where("id", "!=", $demandeurAct->id_fonction)->get();
        $depts = Departement::where("id", "!=", $demandeurAct->id_departement)->get();
        $articles = Article::where("groupe", "!=", $demandeurAct->groupe_article)->get();
        return view("demandeurAct/show", compact("articles", "fcts",  "depts", "demandeur"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DemandeurAct  $demandeurAct
     * @return \Illuminate\Http\Response
     */
    public function edit(DemandeurAct $demandeurAct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DemandeurAct  $demandeurAct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DemandeurAct $demandeurAct)
    {
        try {
            $data = $request->all();
            $demandeurAct->update($data);
            return response(json_encode(["success" => 1, "message" => "Updated"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DemandeurAct  $demandeurAct
     * @return \Illuminate\Http\Response
     */
    public function destroy(DemandeurAct $demandeurAct)
    {
        try {
            $demandeurAct->delete();
            return response(json_encode(["success" => 1, "message" => "Deleted"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }

    function delete($id)
    {
        try {
            $demandeur = DemandeurAct::find($id);
            $demandeur->delete();
            return response(json_encode(["success" => 1, "message" => "Deleted"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
