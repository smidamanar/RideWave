<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = ['conducteur_id', 'depart', 'destination', 'date', 'heure', 'prix', 'nb_places', 'valide'];

    protected $casts = [
        'date' => 'date',
        'prix' => 'float',
        'valide' => 'boolean',
    ];

    public function conducteur()
    {
        return $this->belongsTo(User::class, 'conducteur_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
