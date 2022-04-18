<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $table = "membre";
    public function activites()
    {
        return $this->belongsToMany(Activite::class, "participe", "id_membre", "id_activite");
    }
}
