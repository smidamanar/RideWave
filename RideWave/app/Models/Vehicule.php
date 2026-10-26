<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    public const TYPE_CAR = 'car';
    public const TYPE_BUS = 'bus';
    public const TYPE_VAN = 'van';
    public const TYPE_SUV = 'suv';

    public const TYPES = [
        self::TYPE_CAR => 'Car',
        self::TYPE_BUS => 'Bus',
        self::TYPE_VAN => 'Van',
        self::TYPE_SUV => 'SUV',
    ];

    public const MAX_SEATS_BY_TYPE = [
        self::TYPE_CAR => 5,
        self::TYPE_BUS => 9,
        self::TYPE_VAN => 8,
        self::TYPE_SUV => 7,
    ];

    protected $fillable = [
        'user_id',
        'type',
        'marque',
        'modele',
        'annee',
        'couleur',
        'immatriculation',
        'photo_path',
        'places',
    ];

    public static function types(): array
    {
        return self::TYPES;
    }

    public static function maxSeatsByType(string $type): int
    {
        return self::MAX_SEATS_BY_TYPE[$type] ?? 5;
    }

    public function maxSeats(): int
    {
        return self::maxSeatsByType($this->type);
    }

    public function allowedSeatCount(): int
    {
        return min((int) $this->places, $this->maxSeats());
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class, 'vehicule_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
