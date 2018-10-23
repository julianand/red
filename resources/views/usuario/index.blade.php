@extends('layouts.master')
@section('title', 'App')
@section('controller', 'usuarioController')
@section('content')

<div class="row ml-0" style="position: absolute; left: 0; top: 0; width: 100%; height: 100%;">
	<div class="col-sm-3 pl-0">
		<div class="form-group p-2 opciones-menu">
			<small class="form-text text-primary">Iniciar conversacion</small>
			<input type="text" class="form-control form-control-sm btn-search" ng-model="filtro.name">
			<div class="usuarios bg-white border border-top-0">
				<div ng-if="filtro.name" ng-repeat="usuario in usuarios | filter:filtro:strict" class="p-2 text-primary">
					<button class="btn btn-link text-dark" style="text-decoration: none;"
							ng-click="iniciarConversacion(usuario)">
						@{{usuario.name}}
					</button>
				</div>
			</div>
		</div>
		<small ng-if="usuariosRecientes.length" class="form-text p-2 text-primary">Conversaciones recientes</small>
		<div ng-repeat="usuario in usuariosRecientes" class="form-group py-2 pl-4 opciones-menu">
			@{{usuario.name}}
		</div>
		<div class="form-group p-2 opciones-menu text-center">
			<a role="button" class="btn btn-link p-0" href="login/logout">Cerrar sesion</a>
		</div>
	</div>
	<div ng-if="usuario" class="col-sm-9 p-3">
		<div class="row mx-0 border rounded border-primary" style="height: 100%;">
			<div class="col-sm-12 align-self-start border-bottom border-primary pt-2 pl-3">
				<h4>@{{usuario.name}}</h4>
			</div>
			<div class="col-sm-12 align-self-center">
				
			</div>
			<div class="col-sm-12 align-self-end border-top border-primary">
				<form ng-submit="enviarMensaje()">
					<div class="form-row">
						<div class="col-sm-10 py-1 border-right border-primary">
							<input type="text" class="form-control border-0" style="box-shadow: none;" ng-model="mensaje.mensaje">
						</div>
						<div class="col-sm-2 text-center p-1">
							<input type="submit" class="btn btn-link align-self-center" value="Enviar" style="text-decoration: none;" ng-disabled="!mensaje.mensaje">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection