<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversacion extends Model
{
    public $timestamps = false;
    protected $table = 'conversaciones';
    protected $guarded = ['id'];

    public function mensajes() {
    	return $this->hasMany('App\Mensaje');
    }

    public function usuarios() {
    	return $this->belongsToMany('App\Usuario','conversaciones_usuarios');
    }
}
