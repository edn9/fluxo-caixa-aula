<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControleCaixa extends Model
{
    protected $table = 'controle_caixas';

    protected $primaryKey = 'id';

    protected $casts = [
        'time' => 'datetime:H:00',
    ];

    protected $fillable = [
        'caixa_id', 'action', 'time', 'user_id', 'balance', 'ip', 'browser'
    ];
}
