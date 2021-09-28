<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;
    protected $table = "membre";
    protected $fillable = ["nom", "prenom", "email", "date_de_naissance", "sexe", "mot_de_passe", "avatar", "is_public", "is_connected"];
    public $timestamps = false;
    public function activites()
    {
        return $this->hasMany(Activite::class, "id_membre");
    }
}
