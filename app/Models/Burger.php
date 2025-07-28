<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Burger extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prix',
        'image',
        'description',
        'stock',
        'archive',

    ];

    public function scopeActif($query)
    {
        return $query->where('archive', false);
    }

    public function scopeArchive($query)
    {
        return $query->where('archive', true);
    }

    

}
