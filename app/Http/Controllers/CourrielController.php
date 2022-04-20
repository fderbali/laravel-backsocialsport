<?php

namespace App\Http\Controllers;

use App\Models\Courriel;
use App\Models\Membre;
use http\Env\Response;
use Illuminate\Http\Request;

class CourrielController extends Controller
{
    public function courriels(Membre $membre){
        return $membre->courriels;
    }

    public function sentCourriels(Membre $membre){
        return $membre->sentCourriels;
    }

    public function getCourriel(Courriel $courriel){
        return $courriel;
    }

    public function sendCourriel(Request $request){
        $courriel = Courriel::create($request->all());
        if($courriel){
            return response()->json(['success' => true, 'insert_id' => $courriel->id, 'message' => 'Message effetuée avec succès']);
        } else
        {
            return response()->json(['success'=> false, 'message' => "Une erreur s'est produite, veuillez réessayer plus tard !"]);
        }
    }

    public function markAsRead(Courriel $courriel) {
        $courriel->courriel_lu = "Y";
        if($courriel->save()){
            return response()->json(["success" => true]);
        }
        return response()->json(["success" => false]);
    }
}
