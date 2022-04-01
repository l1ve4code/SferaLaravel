<?php

namespace App\Http\Controllers;

use App\Position;
use App\Skill;
use App\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = [];

        if(request()->has("alphabet")) $search["alphabet"] = request()->alphabet;
        if(request()->has("creation")) $search["creation"] = request()->creation;
        if(request()->has("position")) $search["position"] = request()->position;
        if(request()->has("skill")) $search["skill"] = request()->skill;

        $data["positions"] = Position::all();
        $data["skills"] = Skill::select("name")->distinct()->get();
        $data["users"] = User::getUsers($search);

        return view("pages.index", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!User::find($id)) return redirect(route("index"));

        $data["positions"] = Position::all();
        $data["skills"]    = Skill::where("user_id", "=", $id)->get();

        return view("forms.edit", $data);
    }

    public function find(Request $request){

        $label = $request->input("label");

        $data["positions"] = Position::all();
        $data["skills"] = Skill::select("name")->distinct()->get();

        $data["users"] = User::getUsers([
            "label" => $label
        ]);

        return view("pages.index", $data);

    }

}
