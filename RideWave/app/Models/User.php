<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telephone',
        'profile_photo_path',
        'avatar_style',
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

    public function rideComments()
    {
        return $this->hasMany(RideComment::class);
    }

    // =========================
    // ROLE HELPERS (PRO LEVEL)
    // =========================

    public function isAdmin()
    {
        return $this->canonicalRole() === 'admin';
    }

    public function isDriver()
    {
        return $this->canonicalRole() === 'driver';
    }

    public function isPassenger()
    {
        return $this->canonicalRole() === 'passenger';
    }

    public function canonicalRole(): string
    {
        return match ($this->role) {
            'passager', 'passenger' => 'passenger',
            'conducteur', 'driver' => 'driver',
            'admin' => 'admin',
            default => 'unknown',
        };
    }

    public function storedRole(): string
    {
        return match ($this->canonicalRole()) {
            'passenger' => 'passager',
            'driver' => 'conducteur',
            'admin' => 'admin',
            default => 'unknown',
        };
    }

    public function roleLabel(): string
    {
        return ucfirst($this->canonicalRole());
    }

    public static function avatarThemes(): array
    {
        return [
            'sunset' => [
                'label' => 'Sunset',
                'gradient' => 'linear-gradient(135deg, #f97316 0%, #ec4899 100%)',
            ],
            'skyline' => [
                'label' => 'Skyline',
                'gradient' => 'linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%)',
            ],
            'forest' => [
                'label' => 'Forest',
                'gradient' => 'linear-gradient(135deg, #22c55e 0%, #0f766e 100%)',
            ],
            'midnight' => [
                'label' => 'Midnight',
                'gradient' => 'linear-gradient(135deg, #1f2937 0%, #111827 100%)',
            ],
            'golden' => [
                'label' => 'Golden',
                'gradient' => 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)',
            ],
            'violet' => [
                'label' => 'Violet',
                'gradient' => 'linear-gradient(135deg, #7c3aed 0%, #db2777 100%)',
            ],
        ];
    }

    public function avatarStyle(): string
    {
        $style = (string) $this->avatar_style;
        $themes = self::avatarThemes();

        return array_key_exists($style, $themes) ? $style : 'sunset';
    }

    public function avatarTheme(): array
    {
        $themes = self::avatarThemes();

        return $themes[$this->avatarStyle()];
    }

    public function profileInitial(): string
    {
        $name = trim((string) $this->name);

        if ($name === '') {
            return '?';
        }

        return mb_strtoupper(mb_substr($name, 0, 1));
    }

    public function homeRouteName(): string
    {
        return match ($this->canonicalRole()) {
            'passenger' => 'passenger.home',
            'driver' => 'driver.home',
            'admin' => 'admin.dashboard',
            default => 'passenger.home',
        };
    }
}
