<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use App\Models\DemandeurAct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("users/index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function allUsers($type)
    {
        $no = $type == "ECT" ? 0 : 1;
        return json_encode(User::where("type", $no)->where("role", 0)->get());
    }
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data["password"] = Hash::make($data["password"]);
            User::create($data);
            return response(json_encode(["success" => 1, "message" => "Bien crée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["success" => 0, "message" => $th->getMessage()]), 500);
        }
    }
    public function auth(Request $req)
    {
        try {
            $cred = ["login" => $req->login, "password" => $req->password];
            if (Auth::attempt($cred)) {
                return response(json_encode(["success" => 1, "message" => "Bien connecté", "user" => Auth::user(), "id" => Auth::user()->id]), 200);
            } else {
                return response(json_encode(["success" => 0, "message" => "Login ou mot de passe non valides !"]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->to("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    }
    function changePassword(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $newPass = Hash::make($request->password);
            $user->update(["password" => $newPass]);
            return response(json_encode(["success" => 1, "message" => "Updated"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }

    function accountCreator()
    {
        $ects = Demandeur::all();
        $arr = [];
        $pass = Hash::make("0000");
        foreach ($ects as $ect) {
            $name = explode(" ", $ect->name);
            $login = "";
            if (count($name) > 2) {
                $login = $name[0] . $name[1] . "_" . $name[2];
            } else {
                $login = $name[0] . "_" . $name[1];
            }
            array_push($arr, $login);
            User::create(["login" => $login, "password" => $pass, "role" => 0, "type" => 0]);
        }
        $acts = DemandeurAct::all();
        foreach ($acts as $act) {
            $name = explode(" ", $act->name);
            $login = "";
            if (count($name) > 2) {
                $login = $name[0] . $name[1] . "_" . $name[2];
            } else {
                $login = $name[0] . "_" . $name[1];
            }
            array_push($arr, $login);
            User::create(["login" => $login, "password" => $pass, "role" => 0, "type" => 1]);
        }

        return json_encode(["names" => $arr]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
