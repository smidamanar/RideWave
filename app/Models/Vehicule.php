<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'marque',
        'modele',
        'annee',
        'couleur',
        'immatriculation',
        'places',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
