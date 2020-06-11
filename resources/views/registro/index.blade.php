@extends('layouts.header.navbar')
<title>{{config('app.name')}} - Cadastro</title>

@section('content')
<br><br>
<style type="text/css">
	.btn{
		margin-top: 10px;

	}
	#container-form{
		margin:100px auto;
		width: 45%;

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
    @if($errors->any())
    <div id="card-alert" class="card red lighten-5">
		<div class="card-content red-text">
        @foreach ($errors->all() as $error)
            <p align="center">{{$error}}</p>
        @endforeach
        </div>
    </div>
@endif
    @if(Session::has('success'))
    <div id="card-alert" class="card green lighten-5">
        <div class="card-content green-text">
        <p align="center">Seu cadastro foi feito com êxito! Comece entrando agora mesmo na CryptoPizza!</p>
        </div>
    </div>
    <br>
    @endif

	<div class="row card hoverable">
		<div class="card-content">
            <h3 class="center blue-text">Cadastramento</h3>	
            <div id="card-alert" class="card red accent-2">
                <div class="card-content white-text">
                    <i class="medium material-icons left">warning</i>
                  <p align="center">Antes de continuar o seu registro, indicamos fortemente que leia os nossos <strong>Termos e Condições</strong> e a nossa <strong>Política de Privacidade e de Cookies.</strong>  </p>               
                </div>
            </div>
	
        <form class="row s12" method="post" action="/registrar">
            {{csrf_field()}}
            <div class="col s6">
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
                        <input id="nome" type="text" name="nome" required maxlength="20" data-length="20" value="{{old('nome')}}">
                        <label for="nome">Nome</label>
                    </div>
            </div>
            <div class="col s6">
                <div class="input-field">
                        <input id="sobrenome" type="text" name="sobrenome" required maxlength="40" data-length="40" value="{{old('sobrenome')}}">
                        <label for="sobrenome">Sobrenome</label>
                    </div>
            </div>  
  {{--           <div class="col s12">
                <div class="input-field">            
                    <i class="material-icons prefix">  date_range</i>
                        <input type="text" class="datepicker" name="data_aniversario">
                        <label for="sobrenome">Data de Aniversário</label>
                    </div>
            </div>   --}}
            
            <div class="col s12">
                <div class="input-field">
            <i class="material-icons prefix">account_circle</i>
                    <input id="input_cpf" type="text" name="cpf" required onkeypress="this.value=this.value.replace(/[^\d]/,'')" minlength="11" maxlength="11" data-length="11" value="{{old('cpf')}}">
                    <label for="cpf">CPF</label>
                </div>
            </div>
            <div class="col s12">
                <div class="input-field">
                    <i class="material-icons prefix">mail</i>
                        <input id="mail" type="text" name="email" required maxlength="255" value="{{old('email')}}">
                        <label for="mail">E-mail</label>
                    </div>
            </div>
			<div class="col s12">
			<div class="input-field">
                <i class="material-icons prefix">lock</i>
				<input id="passwd" type="password" required name="passwd" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"  maxlength="32">
                <label for="passwd">Senha</label>
                <span class="helper-text red-text center-align" data-error="wrong" data-success="right">A senha deve possuir no mínimo <strong>8 caracteres</strong>, contendo uma letra maiúscula, um número e um símbolo especial (@, #, !, etc).</span>
			</div>
            </div>
            <div class="col s12">
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input id="passwd_confirmation" type="password" name="passwd_confirmation" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" maxlength="32">
                    <label for="passwd_confirmation">Confirme sua senha</label>
                </div>
                </div>
		
		<div class="col s12">
            <label>
                <input type="checkbox" name="confirmaTermos" required/>
                <span>Eu <strong>confirmo</strong> que li e aceito os Termos e Condições da {{config('app.name')}}.</span>
              </label>
              <label>
                <input type="checkbox" name="confirmaPolitica" required />
                <span>Eu <strong>confirmo</strong> que li e aceito as Políticas de Privacidade e de Cookies da {{config('app.name')}}.</span>
              </label>
		</div>
		<div class="col s12 center">
         
			<button type="submit" class="btn btn-large waves-effect waves-light blue">Registrar <i class="material-icons right">send</i></button>
			<br><br>
		Já possuí uma conta? <a href="{{ route('login.page') }}">Entre aqui!</a>
		</div>	
		</form>
	</div>
</div>
</div>
<br><br>
@endsection



