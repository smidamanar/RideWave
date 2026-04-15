<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Trajet;
use App\Models\Reservation;
use App\Models\Vehicule;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telephone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // =========================
    // RELATIONSHIPS
    // =========================

    public function trajets()
    {
        return $this->hasMany(Trajet::class, 'conducteur_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    // =========================
    // ROLE HELPERS (PRO LEVEL)
    // =========================

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isConducteur()
    {
        return $this->role === 'conducteur';
    }

    public function isPassager()
    {
        return $this->role === 'passager';
    }
}