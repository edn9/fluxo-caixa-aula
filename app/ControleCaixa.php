<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControleCaixa extends Model
{
    protected $table = 'controle_caixas';

    protected $primaryKey = 'id';

    protected $dates = ['time'];

    protected $fillable = [
        'caixa_id', 'action', 'time', 'user_id', 'balance', 'ip', 'browser'
    ];
}
