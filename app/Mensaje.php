<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    public $timestamps = false;
    protected $table = 'mensajes';
    protected $fillable = ['mensaje','fecha','usuario_id'];

    public function usuario() {
    	return $this->belongsTo('App\Usuario');
    }
}
