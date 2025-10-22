<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'nationalite',
        'age',
        'poids',
        'taille',
        'description_rapide',
        'description_complete',
        'photo_profil',
    ];
}
