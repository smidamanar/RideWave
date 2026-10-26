<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'trajet_id',
        'user_id',
        'parent_id',
        'body',
    ];

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id')->latest();
    }
}
