<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'burger_id',
        'quantite',
    ];

    public function burger()
    {
        return $this->belongsTo(Burger::class);
    }
}
