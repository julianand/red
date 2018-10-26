<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    public $timestamps = false;
    protected $table = 'mensajes';
    protected $guarded = ['id'];

    protected $casts = [
    	'fecha'=>'datetime'
    ];

    public function usuario() {
    	return $this->belongsTo('App\Usuario');
    }
}
