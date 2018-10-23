<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword;

    public $timestamps = false;
    protected $table = 'usuarios';
    protected $fillable = ['name','username','password'];
    protected $hidden = ['password','remember_token'];

    public function conversaciones() {
    	return $this->belongsToMany('App\Conversacion','conversaciones_usuarios');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }
}
