<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operations extends Model
{
    public $timestamps= false;

    protected $table= 'operations';

    protected $fillable = [
        'id_user',
        'type_transaction',
        'created_at',
        'value'
    ];
}