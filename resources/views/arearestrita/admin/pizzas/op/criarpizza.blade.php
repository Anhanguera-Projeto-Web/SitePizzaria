@extends('arearestrita.layouts.sidebar')
<nav style='padding-left: 22rem;' class="deep-orange">
  <div class="nav-wrapper ">
    <div class="col s12">
    <a href="{{route('admin.home.page')}}" class="breadcrumb">Dashboard</a>
    <a href="{{route('admin.pizzas.page')}}" class="breadcrumb">Pizzas</a>
    <a href="{{route('admin.criar.pizza')}}" class="breadcrumb">Criar Pizza</a>
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
            <h3 class="center blue-text">Criar uma nova pizza</h3>	
            <div id="card-alert" class="card red accent-2">
            </div>
        <form class="row s12" method="post" action="{{route('admin.criar.pizza')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col s12">
                <div class="input-field">
                    <i class="material-icons prefix">attach_money</i>
                        <input id="preco_pizza" type="number" name="preco_pizza" required step="0.01">
                        <label for="preco_pizza">Valor da Pizza</label>
                    </div>
            </div>    
            <div class="col s4">
                <div class="input-field">
                    <select required name="sabor">
                    <option disabled selected>Escolha um</option>
                    @foreach($sabor as $value)
                    <option value={{$value->id_sabor}} >{{$value->sabor}}</option>
                    @endforeach
                    </select>
                    <label>Sabor da pizza</label>
                </div>
            </div>
            <div class="col s3">
                <div class="input-field">
                    <select required name="tamanho">
                    <option disabled selected>Escolha um</option>  
                    @foreach($tamanho as $value)           
                    <option value={{$value->id_tamanho}}>{{$value->tamanho}}</option>
                    @endforeach
                    </select>
                    <label>Tamanho da pizza</label>
                </div>
            </div>
            <div class="col s2">
                <div class="input-field">
                    <div class="switch">
                        <label>
                          Não
                          <input type="checkbox" name="disponibilidade" value='sim' data-valuetwo="nao">
                          <span class="lever"></span>
                          Sim
                        </label>
                      </div>
                </div>
                <label>Disponível?</label>
            </div>
            <div class="col s3">
                <div class="input-field">
                    <div class="input-field">
                        <input type="file" name="foto_pizza" accept="image/jpg"/>
                    </div>
                    <span class="helper-text red-text center-align" data-error="wrong" data-success="right">Se for um sabor existente, não é necessário uma nova foto.</span>
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