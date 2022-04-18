<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Membre::orderByDesc("id")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Membre::create($request->all())) {
            return response()->json([
                "success" => true,
                "message" => "Membre enregistrée avec succès !"
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Une erreur s'est produite, veuillez réessayer plus tard !"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membre  $membre
     * @return \Illuminate\Http\Response
     */
    public function show(Membre $membre)
    {
        return $membre;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membre  $membre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membre $membre)
    {
        if ($membre->update($request->all())) {
            return response()->json([
                "succes" => true,
                "message" => "Membre modifié avec succès !",
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membre  $membre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membre $membre)
    {
        $membre->delete();
    }

    public function getActivites($id)
    {
        return Membre::findOrFail($id)->activites;
    }
}
