<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Usuario;
use App\Conversacion;

class UsuarioController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex() {
        return view('usuario.index');
    }

    public function getUsuarios() {
        $usuarios = Usuario::all();

        $usuarios_res = [];
        foreach ($usuarios as $key => $value) {
            if($value != \Auth::user()) array_push($usuarios_res, $value);
        }

        return $usuarios_res;
    }

    public function postEnviarMensaje(Request $request, $id) {
        $conversaciones = Conversacion::with('usuarios')->with('mensajes')->get();
        $usuario = Usuario::find($id);
        foreach ($conversaciones as $key => $conversacion) {
            if($conversacion->usuarios->contains(\Auth::user()) && $conversacion->usuarios->contains($usuario)) {
                $conversacionRes = $conversacion;
            }
        }

        if(!isset($conversacionRes)) {
            $conversacionRes = new Conversacion();
            $conversacionRes->save();
            $conversacionRes->usuarios()->attach(\Auth::user());
            $conversacionRes->usuarios()->attach($id);
        }
        return $conversacionRes;
    }  
}
