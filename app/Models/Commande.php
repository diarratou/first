<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'statut',
        'total',
        'date_commande',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function burger()
    {
        return $this->belongsToMany(Burger::class, 'commande_burgers')
            ->withPivot('quantite');
    }

}


