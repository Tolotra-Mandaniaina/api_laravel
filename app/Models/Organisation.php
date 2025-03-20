<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
           
    protected $fillable = ["denomination", "sigle", "statut", "anneeConstitution", "numeroEnregistrement", "region", "codeRegion", "district", "codeDistrict", "commune", "codeCommune", "adresse", "siteWeb", "fb", "email", "tel" ];


    public function personnes()
    {
        return $this->hasMany(Personne::class);
    }
}
