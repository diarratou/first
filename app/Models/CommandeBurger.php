<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeBurger extends Model
{
    use HasFactory;

    protected $table = 'commande_burgers';

    /**
     * Les attributs qui sont attribuables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'commande_id',
        'burger_id',
        'quantite',
    ];
}
