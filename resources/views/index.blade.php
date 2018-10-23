@extends('layouts.master')
@section('title', 'Login')
@section('controller', 'LoginController')
@section('content')

<div class="container">
	<section class="row justify-content-center mt-5">
		<div class="col-sm-6 shadow">
			<form ng-submit="login()">
				<div class="form-group">
					<label>Usuario</label>
					<input type="text" class="form-control" ng-model="loginInput.username">
					<small class="form-control-text text-danger">@{{errors.username[0]}}</small>
				</div>
				<div class="form-group">
					<label>Contraseña</label>
					<input type="password" class="form-control" ng-model="loginInput.password">
					<small class="form-control-text text-danger">@{{errors.password[0]}}</small>
				</div>
				<div class="form-group text-center">
					<input type="submit" value="Entrar" class="btn btn-primary btn-block">
					<small class="form-control-text text-danger" ng-if="errors.data">
						Nombre de usuario o contraseña incorrectos
					</small>
					<input type="button" value="Registrate" class="btn btn-link btn-block" data-toggle="modal" data-target="#registrarModal">
				</div>
			</form>
		</div>
	</section>
	<div class="modal fade" id="registrarModal" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="border: 0">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">Registrate</h5>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" class="form-control" ng-model="registroInput.name">
							<small class="form-control-text text-danger">@{{errors.name[0]}}</small>
						</div>
						<div class="form-group">
							<label>Usuario</label>
							<input type="text" class="form-control" ng-model="registroInput.username">
							<small class="form-control-text text-danger">@{{errors.username[0]}}</small>
						</div>
						<div class="form-group">
							<label>Contraseña</label>
							<input type="password" class="form-control" ng-model="registroInput.password">
							<small class="form-control-text text-danger">@{{errors.password[0]}}</small>
						</div>
					</form>
				</div>
				<div class="modal-footer">
        			<button type="button" class="btn btn-primary" ng-click="registrar()">Registrate</button>
					<button style="text-decoration: none;" type="button" class="btn btn-link text-link" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection