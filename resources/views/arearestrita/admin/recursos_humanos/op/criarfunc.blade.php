@extends('arearestrita.layouts.sidebar')
<nav style='padding-left: 22rem;' class="deep-orange">
  <div class="nav-wrapper ">
    <div class="col s12">
    <a href="{{route('admin.home.page')}}" class="breadcrumb">Dashboard</a>
    <a href="{{route('admin.func.page')}}" class="breadcrumb">Funcionários</a>
    <a href="{{route('admin.criar.func')}}" class="breadcrumb">Criar Funcionário</a>
    </div>
  </div>
</nav>
@section('content')
<div class='container'> 
	<div class="row center-align card hoverable" style="width: 65rem;">
		<div class="card-content" style="width: 65rem;">
            <h3 class="center blue-text">Registrar novo funcionário</h3>	
            <div id="card-alert" class="card red accent-2">
            </div>
        <form class="row s12" method="post" action="{{route('admin.criar.func')}}" enctype="multipart/form-data">
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
            <div class="col s9">
                <div class="input-field">
                    <div class="input-field">
                        <select required name="nivel">
                        <option disabled selected>Escolha um</option>
                        <option value=1>Moderador/Atendente</option>
                        <option value=2>Administrador</option>
                        </select>
                        <label>Selecione o nível do funcionário</label>
                    </div>
                </div>
            </div>
            <div class="col s3">
                <div class="input-field">
                    <div class="input-field">
                        <input type="file" name="foto_id" accept="image/jpg"/>
                    </div>
                </div>
            </div>         
		<div class="col s12 right-align">
			<button type="submit" class="btn btn-large waves-effect waves-light green">Registrar <i class="material-icons right">send</i></button>
			<br><br>
		</div>	
		</form>
	</div>
</div>
@endsection