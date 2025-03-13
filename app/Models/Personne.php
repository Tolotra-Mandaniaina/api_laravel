<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $fillable = ["nom", "age", "tel", "psh", "email", "fb", "fonction", "organisation", "region", "codeRegion", "district", "codeDistrict", "commune", "codeCommune"];

    public function activites()
        {
            return $this->belongsToMany(Activite::class, 'fiche_presences')
                        ->withPivot('est_present')
                        ->withTimestamps();
        }

    
}
