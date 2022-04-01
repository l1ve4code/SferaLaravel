<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $request, $id)
    {
        $validated = $request->validated();

        Skill::create([
            "user_id" => $id,
            "name" => $validated["skill"]
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
        Skill::destroy($id);

        return redirect()->back();
    }
}
