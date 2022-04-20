<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $table = "activite";
    protected $fillable = ["nom", "lieu", "nombre", "id_categorie", "debut", "fin", "description"];
    public $timestamps = false;
    public function membre()
    {
        return $this->belongsTo(Membre::class, "id_membre");
    }

    public function participants()
    {
        return $this->belongsToMany(Membre::class, "participe", "id_activite", "id_membre");
    }
}
