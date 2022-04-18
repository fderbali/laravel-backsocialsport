<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Activite::orderByDesc('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Activite::create($request->all())) {
            return response()->json([
                "success" => true,
                "message" => "Activité enregistrée avec succès !"
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
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function show(Activite $activite)
    {
        return $activite;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activite $activite)
    {
        if ($activite->update($request->all())) {
            return response()->json([
                "succes" => true,
                "message" => "Activité modifié avec succès !",
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activite $activite)
    {
        $activite->delete();
    }
    public function getParticipants($id)
    {
        $activite = Activite::find($id);
        return $activite->participants;
    }
}
