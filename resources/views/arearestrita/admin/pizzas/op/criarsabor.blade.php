@extends('arearestrita.layouts.sidebar')
<nav style='padding-left: 22rem;' class="deep-orange">
  <div class="nav-wrapper ">
    <div class="col s12">
    <a href="{{route('admin.home.page')}}" class="breadcrumb">Dashboard</a>
    <a href="{{route('admin.sabores.page')}}" class="breadcrumb">Sabores</a>
    <a href="{{route('admin.criar.sabor')}}" class="breadcrumb">Criar Sabor</a>
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
            <h3 class="center blue-text">Registrar um novo sabor</h3>	
            <div id="card-alert" class="card red accent-2">
            </div>
        <form class="row s12" method="post" action="{{route('admin.criar.sabor')}}">
            {{csrf_field()}}
            <div class="col s12">
                <div class="input-field">
                    <i class="material-icons prefix">local_pizza</i>
                        <input id="sabor" type="text" name="sabor" required maxlength="30" data-length="30" value="{{old('sabor')}}">
                        <label for="sabor">Sabor</label>
                    </div>
            </div>
            <div class="col s12">
                <div class="input-field">
                    <i class="material-icons prefix">create</i>
                        <input id="desc_sabor" type="text" name="desc_sabor" required maxlength="100" data-length="100" value="{{old('desc_sabor')}}">
                        <label for="desc_sabor">Descrição da Pizza</label>
                    </div>
            </div>
            
		<div class="col s12 right-align">
			<button type="submit" class="btn btn-large waves-effect waves-light green">Criar<i class="material-icons right">send</i></button>
			<br><br>
		</div>	
		</form>
	</div>
</div>
@endsection