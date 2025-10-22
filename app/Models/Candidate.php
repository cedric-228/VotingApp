<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

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