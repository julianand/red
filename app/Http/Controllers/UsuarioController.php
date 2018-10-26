<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Usuario;
use App\Conversacion;
use App\Mensaje;

use Carbon\Carbon;

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

    public function getCargarConversacion($id) {
        return Conversacion::with('usuarios')
                            ->with('mensajes')
                            ->get()
                            ->filter(function($conv) use($id) {
                                $usr = $conv->usuarios;
                                return $usr->contains(\Auth::user()->id)  && $usr->contains($id);
                            })->first();
    }

    public function postEnviarMensaje(Request $request, $id) {
        $conversacion = Conversacion::with('usuarios')
                        ->with('mensajes')
                        ->get()
                        ->filter(function($value) use($id) {
                            $usuarios = $value->usuarios;
                            return $usuarios->contains(\Auth::user()->id) && $usuarios->contains($id);
                        })->first();
        
        if(!$conversacion) {
            $conversacion = new Conversacion();
            $conversacion->save();
            $conversacion->usuarios()->attach(\Auth::user()->id);
            $conversacion->usuarios()->attach($id);
        }

        $mensaje = Mensaje::create([
            'conversacion_id'=>$conversacion->id,
            'usuario_id'=>\Auth::user()->id,
            'mensaje'=>$request->mensaje,
            'hora'=>Carbon::now(),
        ]);
    }  
}
