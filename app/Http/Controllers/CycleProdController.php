<?php

namespace App\Http\Controllers;

use App\Models\CycleProd;
use Illuminate\Http\Request;

class CycleProdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return json_encode(CycleProd::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            CycleProd::create($request->all());
            return response(json_encode(["success" => 1, "message" => "Bien crée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["success" => 0, "message" => $th->getMessage()]), 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CycleProd  $cycleProd
     * @return \Illuminate\Http\Response
     */
    public function show(CycleProd $cycleProd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CycleProd  $cycleProd
     * @return \Illuminate\Http\Response
     */
    public function edit(CycleProd $cycleProd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CycleProd  $cycleProd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CycleProd $cycleProd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CycleProd  $cycleProd
     * @return \Illuminate\Http\Response
     */
    public function destroy(CycleProd $cycleProd)
    {
        //
    }
}
