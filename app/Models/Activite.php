<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = ["nom", "description", "dateDebut", "dateFin", "lieu", "projet_id"];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function personnes()
    {
    return $this->belongsToMany(Personne::class, 'fiche_presences')
                ->withPivot('est_present')
                ->withTimestamps();
    }

    

}
  