@extends('layouts.header.navbar')
<title>{{config('app.name')}} - Contato</title>

@section('content')
<br><br>
<style type="text/css">

	.btn{
		margin-top: 10px;

	}
	#container-form{
		margin:100px auto;
		width: 50%;

	}
	@media(max-width: 952px){
		.container{
			width: 60%;
		}
	}
		@media(max-width: 475px){
		.container{
			width: 90%;
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
		<div class="card-content green-text center">
		  <p>Sua mensagem foi enviada com êxito! Responderemos o mais breve possível a partir do e-mail informado. Obrigado por utilizar nosso canal de contato.</p>
		</div>
	</div>
	<br>
	@endif
	
	<div class="row card hoverable">
		<div class="card-content z-depth-4">
		<h3 class="center blue-text">Área de Contato</h3>
		<p>Todo serviço de atendimento ao consumidor (SAC) da {{config('app.name')}} deve ser realizado pelo
			 site ou através de email, preenchendo o formulário abaixo. 
			Caso necessite entrar em contato com a {{config('app.name')}} de forma direta, ligue para nosso telefone. 
		 	Você pode entrar em contato pelos seguinte número: <b> (021) 1234-5678</b></p>
			  <br>

	<form class="row s12" method="post" action="{{route('contacting.page')}}">
		{{csrf_field()}}
		<div class="col s12">
			<div class="input-field">
				<select required name="assunto">
				<option disabled selected>Escolha um</option>
				<option value="1">Informação</option>
				<option value="2">Reclamação/Crítica/Feedback</option>
				<option value="3">Problemas Financeiros</option>
				<option value="4">Problemas com minha conta</option>
				<option value="5">Outro(s)</option>
				</select>
				<label>Selecione</label>
			</div>
		</div>
		<div class="col s6">
			<div class="input-field">
				<i class="material-icons prefix">person</i>
					@if(Auth::guest())
					<input id="prim_nome" type="text" name="nome_requerente" required maxlength="50" data-length="50" value="{{old('nome_requerente')}}">
					@else
					<input id="prim_nome" type="text" name="nome_requerente" required maxlength="50" data-length="50" value="{{Auth::user()->nome}} {{Auth::user()->sobrenome}}">
					@endif
					<label for="prim_nome">Nome completo</label>
				</div>
		</div>
		<div class="col s6">
			<div class="input-field">
				@if(Auth::guest())
				<input id="input_cpf" type="text" name="cpf_requerente" required onkeypress="this.value=this.value.replace(/[^\d]/,'')" maxlength="11" data-length="11" value="{{old('cpf_requerente')}}">
				@else
				<input id="input_cpf" type="text" name="cpf_requerente" required onkeypress="this.value=this.value.replace(/[^\d]/,'')" maxlength="11" data-length="11" value="{{Auth::user()->cpf}}">
				@endif
				<label for="cpf">CPF</label>
				</div>
		</div>

		<div class="col s12">
			<div class="input-field">
				<i class="material-icons prefix">contact_mail</i>
					@if(Auth::guest())
					<input id="mail" type="email" name="mail_requerente" required maxlength="255" value="{{old('mail_requerente')}}">
					@else
					<input id="mail" type="email" name="mail_requerente" required maxlength="255" value="{{(Auth::user()->email)}}">
					@endif
					<label for="mail">E-mail de contato</label>
				</div>
		</div>

		<div class="col s12">
			<div class="input-field">
					<i class="material-icons prefix">subject</i>
						<input id="title" type="text" name="titulo_contato" required maxlength="100" data-length="100" value="{{old('titulo_contato')}}">
						<label for="title">Título do Assunto</label>
			</div>
		</div>

			<div class="col s6">
				<div class="input-field">
				<i class="material-icons prefix">place</i> 
				<input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" maxlength="8" type="number" value="{{old('cep')}}">
				</div>	
		</div>

		<div class="col s6">
				<div class="input-field">
				<i class="material-icons prefix">location_city</i> 
				<input type="text" class="form-control" id="city" name="cidade" placeholder="Cidade" required type="text" value="{{old('cidade')}}">
				</div>	
		</div>
			
		<div class="col s12">
				<div class="input-field">
				<i class="material-icons prefix">streetview</i> 
				<input type="text" class="form-control" id="street" name="logradouro" placeholder="Logradouro" required type="text" value="{{old('logradouro')}}">
				</div>	
		</div>
			
		<div class="col s12">
				<div class="input-field">
					<i class="material-icons prefix">mode_edit</i>
					<textarea id="contato_text" class="materialize-textarea" name="txt_chamado"></textarea>
					<label for="contato_text">Sua mensagem</label>
				</div>
		</div>
			
		<div class="col s12 center">
				<button class="btn-large waves-effect waves-light" type="submit">Enviar
					<i class="material-icons right">send</i>
				</button>
		</div>

	</form>
		</div>
	</div>
</div>
<script src="/src/js/contato.js"></script>
<br><br>
@endsection