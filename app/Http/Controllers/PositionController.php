<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Position;
use App\Skill;
use App\User;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data["positions"] = Position::all();

        return view("forms.position", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        $validated = $request->validated();

        Position::create([
            "name" => $validated["position"]
        ]);

        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, $id)
    {
        $validated = $request->validated();

        User::find($id)->update([
            "position_id" => $validated["position"]
        ]);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != 1 && $id != 2) Position::destroy($id);

        return redirect()->back();
    }
}
