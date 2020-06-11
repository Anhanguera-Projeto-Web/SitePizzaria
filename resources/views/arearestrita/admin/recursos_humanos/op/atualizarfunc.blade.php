@extends('arearestrita.layouts.sidebar')
<nav style='padding-left: 22rem;' class="deep-orange">
  <div class="nav-wrapper ">
    <div class="col s12">
    <a href="{{route('admin.home.page')}}" class="breadcrumb">Dashboard</a>
    <a href="{{route('admin.func.page')}}" class="breadcrumb">Funcionários</a>
    <a class="breadcrumb">Atualizar Funcionário</a>
    </div>
  </div>
</nav>
@section('content')
<div class='container'> 
    @if($errors->any())
<div id="card-alert" class="card red lighten-5" style="width: 65rem;">
    <div class="card-content red-text">
    @foreach ($errors->all() as $error)
        <p align="center">{{$error}}</p>
    @endforeach
    </div>
</div>
@endif
	<div class="row center-align card hoverable" style="width: 65rem;">
        <div class="card-content" style="width: 65rem;">
            @foreach($data as $value)
        <h3 class="center blue-text">Atualizar registro do {{$value->nome}} {{$value->sobrenome}}</h3>	
            <div id="card-alert" class="card red accent-2"></div>
        <form class="row s12" method="post" action="{{route('admin.att.func')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{ method_field('PUT') }}
        <input type="hidden" name="id_usuario" value="{{$value->id_usuario}}">
            <div class="col s6">
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
                        <input id="nome" type="text" name="nome" required maxlength="20" data-length="20" value="{{$value->nome}}">
                        <label for="nome">Nome</label>
                    </div>
            </div>
            <div class="col s6">
                <div class="input-field">
                        <input id="sobrenome" type="text" name="sobrenome" required maxlength="40" data-length="40" value="{{$value->sobrenome}}">
                        <label for="sobrenome">Sobrenome</label>
                    </div>
            </div>  
            <div class="col s12">
                <div class="input-field">
                    <i class="material-icons prefix">mail</i>
                        <input id="mail" type="text" name="email" required maxlength="255" value="{{$value->email}}">
                        <label for="mail">E-mail</label>
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
                        <label>Edite o nível do funcionário</label>
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
			<button type="submit" class="btn btn-large waves-effect waves-light green">Atualizar<i class="material-icons right">update</i></button>
			<br><br>
		</div>	
		</form>
	</div>
</div>
@endforeach
@endsection