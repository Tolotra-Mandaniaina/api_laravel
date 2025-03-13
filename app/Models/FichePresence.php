<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FichePresence extends Model
{
    use HasFactory;

    protected $fillable = ['personne_id', 'activite_id', 'est_present'];


    public function personne()
    {
        return $this->belongsTo(Personne::class);
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    

}
