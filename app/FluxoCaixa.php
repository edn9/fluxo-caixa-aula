<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FluxoCaixa extends Model
{
    protected $table = 'fluxo_caixas';

    protected $primaryKey = 'id';

    protected $casts = [
        'time' => 'datetime:H:00',
    ];

    protected $fillable = [
        'time', 'description', 'action', 'cash', 'credit', 'debit', 'balance', 'caixa_id'
    ];
}
