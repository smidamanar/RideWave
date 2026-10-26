<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'conducteur_id',
        'vehicule_id',
        'depart',
        'destination',
        'date',
        'heure',
        'prix',
        'nb_places',
        'valide',
        'smoking_allowed',
        'pets_allowed',
        'baggage_allowed',
        'food_drinks_allowed',
        'ac_included',
    ];

    protected $casts = [
        'date' => 'date',
        'prix' => 'float',
        'valide' => 'boolean',
        'smoking_allowed' => 'boolean',
        'pets_allowed' => 'boolean',
        'baggage_allowed' => 'boolean',
        'food_drinks_allowed' => 'boolean',
        'ac_included' => 'boolean',
    ];

    public function conducteur()
    {
        return $this->belongsTo(User::class, 'conducteur_id');
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function confirmedReservations()
    {
        return $this->reservations()->where('statut', Reservation::STATUS_CONFIRMED);
    }

    public function comments()
    {
        return $this->hasMany(RideComment::class)->whereNull('parent_id')->latest();
    }
}
