<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FluxoCaixa extends Model
{
    protected $table = 'fluxo_caixas';

    protected $primaryKey = 'id';
    
    protected $dates = ['time'];

    protected $fillable = [
        'time', 'description', 'action', 'cash', 'credit', 'debit', 'balance', 'caixa_id'
    ];
}
