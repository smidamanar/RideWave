<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'en_attente';
    public const STATUS_CONFIRMED = 'confirmee';
    public const STATUS_REJECTED = 'refusee';
    public const STATUS_CANCELLED = 'annulee';

    protected $fillable = [
        'user_id',
        'trajet_id',
        'date_reservation',
        'nb_places',
        'statut',
    ];

    protected $casts = [
        'date_reservation' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function avis()
    {
        return $this->hasOne(Avis::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('statut', [self::STATUS_PENDING, self::STATUS_CONFIRMED]);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('statut', self::STATUS_CONFIRMED);
    }
}
