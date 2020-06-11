@extends('layouts.header.navbar')
<title>{{config('app.name')}} - Login</title>

@section('content')
<br><br>
<style type="text/css">
	.btn{
		margin-top: 10px;

	}
	#container-form{
		margin:100px auto;
		width: 35%;

	}
	@media(max-width: 952px){
		.container{
			width: 60%;
		}
	}
		@media(max-width: 475px){
		.container{
			width: 80%;
		}
	}
</style>
<div class="container" id="container-form">
	@if(Session::has('Error'))
    <div id="card-alert" class="card red lighten-5">
        <div class="card-content red-text">
        <p align="center">{{ Session::get('Error')}}</p>
        </div>
    </div>
	<br>
	@endif

	<div class="row card hoverable">
		<div class="card-content z-depth-4">
		<h3 class="center blue-text">Área de Login</h3>
		<form class="row s12" method="post" action="{{route('logging.page')}}">
		{{csrf_field()}}
		<div class="col s12">
			<div class="input-field">
        <i class="material-icons prefix">account_circle</i>
				<input id="input_cpf" type="text" name="cpf" required onkeypress="this.value=this.value.replace(/[^\d]/,'')" maxlength="11" data-length="11">
				<label for="cpf">CPF</label>
			</div>
		</div>
			<div class="col s12">
			<div class="input-field">
        <i class="material-icons prefix">lock</i>
		<input id="passwd" type="password" required name="passwd" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"  maxlength="32">
				<label for="passwd">Senha</label>
			</div>
		</div>
		
		<div class="col s12">
			
		</div>
		<div class="col s12 center">
		
			<button type="submit" class="btn btn-large waves-effect waves-light blue">Entrar<i class="material-icons right">send</i></button>
			<br><br>
		Não possui uma conta? <a href="{{ route('register.page') }}">Registre-se aqui!</a>
		</div>	
		</form>
	</div>
</div>
</div>
<br><br>
@endsection



