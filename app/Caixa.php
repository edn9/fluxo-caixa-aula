<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    protected $table = 'caixas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cod', 'description'
    ];
}
