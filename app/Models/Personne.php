<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $fillable = ["nom", "age", "tel", "psh", "email", "fb", "region", "codeRegion", "district", "codeDistrict", "commune", "codeCommune","organisation_id","fonction_fiche"];

     public function activites()
        {
            return $this->belongsToMany(Activite::class, 'fiche_presences')
                        ->withPivot('est_present')
                        ->withTimestamps();
        }


      public function organisation()
        {
            return $this->belongsTo(Organisation::class);
        }

        public function fonctions()
        {
            return $this->belongsToMany(Fonction::class, 'fonction_personne', 'personne_id', 'fonction_id');
        }

    
}
