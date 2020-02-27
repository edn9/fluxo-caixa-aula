<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{

    protected $table = 'usuarios';

    protected $fillable = [
        'name', 'age', 'phone', 'email', 'address', 'created_at', 'updated_at'
    ];
}
