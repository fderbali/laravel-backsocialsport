<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Participe;
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
     * Login a member
     */
    public function login(Request $request)
    {
        $membre = Membre::select('*')
            ->where('email', '=', $request->email)
            ->where('mot_de_passe', '=', $request->mot_de_passe)
            ->get();
        if($membre->count()){
            $loggedMembre = $membre[0];
            return response()->json([
                "success" => true,
                "id" => $loggedMembre->id,
                "message" => "Bienvenue ".$loggedMembre->prenom." ".$loggedMembre->nom." !"
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "Mauvaises informations de connexion"
        ]);
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
            ]);
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

    public function checkInscription(Request $request)
    {
        $participe = Participe::select('*')
            ->where('id_membre', '=', $request->id_membre)
            ->where('id_activite', '=', $request->id_activite)
            ->get();
        if($participe->count()){
            $participation = $participe[0];
            return response()->json([
                "subscribed" => true,
            ]);
        }
        return response()->json([
            "subscribed" => false
        ]);
    }

    public function inscrire(Request $request){
        if(Participe::create($request->all()))
        {
            return response()->json(['message' => 'Vous êtes désormais enregistré pour cette activité !' ]);
        }
        else
        {
            return response()->json(['message' => 'Enregistrement échoué ! Veuillez re-essayer plus tard !' ]);
        }
    }

    public function desinscrire(Request $request){
        $participes = Participe::where([['id_membre',$request->id_membre],['id_activite', $request->id_activite]])->get();
        $participe = $participes[0];
        if($participe->delete())
        {
            return response()->json(['message' => 'Vous êtes désormais désinscrit de cette activité !' ]);
        }
        else
        {
            return response()->json(['message' => 'Désinscription échouée ! Veuillez re-essayer plus tard !' ]);
        }
    }
}
