<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CycleProd;
use App\Models\Demandeur;
use App\Models\Site;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function compte(Request $request)
    {
        try {
            $demandeur = Demandeur::where("id", $request->id_demandeur)->with("departement")->first();
            $article = Article::where("id", $request->id_article)->with("fonction")->first();
            $site = Site::where("id", $request->id_site)->first();
            $cycle = CycleProd::where("id", $request->id_cycle)->first();

            $code_dept = $demandeur->departement->code;
            $code_site = $site->code;
            $code_cycle = $cycle->code;
            $code_fct = substr($article->fonction->fonction, -3);
            return response(json_encode(["compte" => "" . $code_site . "" . $code_cycle . "" . $code_dept . "" . $code_fct, "demandeur" => $demandeur, "article" => $article]), 201);
        } catch (\Throwable $th) {
            return response(json_encode(["success" => 0, "message" => $request->all()]), 500);
        }
    }
}
