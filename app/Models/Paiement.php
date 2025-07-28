<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont attribuables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'commande_id',
        'montant',
        'date_paiement',
    ];

    /**
     * Une relation "appartient à" avec la commande.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
