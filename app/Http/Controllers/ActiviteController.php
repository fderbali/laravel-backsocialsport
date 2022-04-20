<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Membre;
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
        $membres = Membre::select('*')
            ->where('email', '=', $request->userConnected)
            ->get();
        if ($membres->count()) {
            $activite = new Activite();
            $activite->fill($request->all());
            $activite->id_membre = $membres[0]->id;
            $activite->id_categorie = $request->categorie;
            $activite->debut = $request->date_debut_activite;
            $activite->fin  = $request->date_fin_activite;
            if ($activite->save()) {
                return response()->json([
                    "success" => true,
                    "insert_id" => $activite->id,
                    "message" => "Activité enregistrée avec succès !"
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Une erreur s'est produite, veuillez réessayer plus tard !"
                ]);
            }
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
            ]);
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

    /**
     * get members participating to the activity !
     * @param $id
     * @return mixed
     */
    public function getParticipants($id)
    {
        $activite = Activite::find($id);
        return $activite->participants;
    }

    public function organisateur($id)
    {
        $activite = Activite::find($id);
        $membre = Membre::find($activite->id_membre);
        if($membre){
            return $membre;
        }
        return response()->json(['success' => false]);
    }
}
