var inputs = document.querySelectorAll('input[type="password"]');
for (var i = inputs.length - 1; i >= 0; i--) {
	inputs[i].addEventListener('keypress', function(event) {
		if(event.keyCode == 32) event.preventDefault();
	});
}

function sha1(value) {
	var sha1 = new jsSHA('SHA-1','TEXT');
	sha1.update(value);
	return sha1.getHash('HEX');
}

var app = angular.module('app', []);
app.controller('LoginController', function($scope, $http) {
	//Login
		$scope.loginInput = new Object();
		$scope.loginInput.password = "";
		$scope.login = function() {
			if($scope.loginInput.password) {
				$scope.loginInput.password = sha1($scope.loginInput.password);
			}
			$http({
				method:'POST',
				data:$scope.loginInput,
				url:$scope.raiz+'/login/login'
			}).then(function(response) {
				$scope.errors = new Object();
				$scope.loginInput = new Object();
				$scope.loginInput.password = "";
				if(response.data == 1) $scope.errors.data = true;
				else {
					window.location.href = $scope.raiz+'/';
				}
			}, function(response) {
				$scope.errors = response.data;
				$scope.loginInput.password = "";
			});
		}

	//Registro
		$scope.registroInput = new Object();
		$scope.registroInput.password = "";
		$scope.registrar = function() {
			if($scope.registroInput.password != "") $scope.registroInput.password = sha1($scope.registroInput.password);
			$http({
				method:'POST',
				data:$scope.registroInput,
				url:$scope.raiz+'/login/registrar'
			}).then(function(response) {
				$scope.errors = null;
				$scope.registroInput = new Object();
				$scope.registroInput.password = "";
				$('#registrarModal').modal('hide');
			}, function(response) {
				$scope.errors = response.data;
				$scope.registroInput.password = "";
			});
		}
});

app.controller('usuarioController', function($scope, $http, $timeout, $interval) {
	$scope.mensaje = '';
	$timeout(function() {
		$http.get($scope.raiz+'/usuario/usuarios').then(function(response) {
			$scope.usuarios = response.data;
		});
	}, 10);

	function cargarConversacion() {
		$http.get($scope.raiz+'/usuario/cargar-conversacion/'+$scope.usuario.id).then(function(response) {
			$scope.conversacion = response.data;
		});
	}

	//iniciar conversacion
		$scope.usuariosRecientes = [];
		$scope.iniciarConversacion = function(usuario) {
			$scope.usuario = usuario;
			$scope.filtro.name = "";
			if($scope.usuariosRecientes.indexOf(usuario) == -1) {
				$scope.usuariosRecientes.push(usuario);
			}

			cargarConversacion();
		};

	//conversacion
		$scope.mensajeInput = new Object();
		$scope.enviarMensaje = function() {
			$http.post($scope.raiz+'/usuario/enviar-mensaje/'+$scope.usuario.id, $scope.mensajeInput).then(function(response) {
				$scope.mensajeInput = new Object();
				$scope.errors = null;
				cargarConversacion();
			}, function(response) {
				$scope.errors = response.data;
			});
		}

		$interval(function() {
			if($scope.usuario) cargarConversacion();
		}, 2000);
});