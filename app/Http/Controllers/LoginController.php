<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Usuario;

class LoginController extends Controller
{
    public function postLogin(Request $request) {
    	$this->validate($request, [
    		'username'=>'required',
    		'password'=>'required'
    	]);
        if (\Auth::attempt(['username'=>$request->username, 'password'=>$request->password], false)) {
        	return 0;
        }
        return 1;
    }

    public function postRegistrar(Request $request) {
    	$this->validate($request, [
    		'name'=>'required',
    		'username'=>'required|unique:usuarios',
    		'password'=>'required'
    	]);
    	return Usuario::create($request->all());
    }

    public function getLogout() {
        \Auth::logout();
        return \Redirect::to('/');
    }
}