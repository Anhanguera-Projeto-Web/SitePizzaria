@extends('arearestrita.layouts.sidebar')
<nav style='padding-left: 22rem;'  class="deep-orange">
  <div class="nav-wrapper">
    <div class="col s12">
    <a href="{{route('admin.home.page')}}" class="breadcrumb">Dashboard</a>
    <a href="{{route('admin.pizzas.page')}}" class="breadcrumb">Pizzas</a>
    </div>
  </div>
</nav>
@section('content')
<div id="modal_delete" class="modal" style= "width: 35%; heighth: 20%;">
  <div class="modal-content  grey lighten-4">
    <form action="{{route('admin.deletar.pizza')}}" method="POST" class="remove-record-model">
      {{ method_field('delete') }}
      {{ csrf_field() }}
    <h4 class="center-align">Você deseja deletar esta pizza?</h4>
    <p class="center-align red-text">Esta ação não poderá ser revertida.</p>
  </div>
  <div class="modal-footer  grey lighten-2">
    <input type="hidden" name="id_pizza" id="pizza_id">
    <button class="btn red darken-2" type="submit" name="action">Deletar<i class="material-icons left">delete</i></button>
    <a class="modal-close waves-effect waves btn-flat"><i class="material-icons left">cancel</i>Cancelar</a>
  </form>
  </div>
</div>

<div class="fixed-action-btn">
  <a class="btn-floating btn-large green" href="{{route('admin.criar.pizza')}}">
      <i class="large material-icons">add</i>
    </a>
</div>
<table class="responsive-table highlight">
  <thead>
    <tr>
        <td>ID</td>
        <td>Sabor</td>
        <td>Descrição</td> 
        <td>Preço</td>
        <td>Tamanho</td> 
        <td>Disponível</td> 
        <td>Criado em</td>
        <td>Atualizado em</td>
    </tr>
</thead>
<tbody>
  @foreach($data as $value)
 <tr>
  <td>{{$value->id_pizza}}</td>
  <td>{{$value->sabores[0]['sabor']}}</td>
  <td>{{$value->sabores[0]['desc_sabor']}}</td>
  <td>R${{$value->preco_pizza}}</td>  
  <td>{{$value->tamanhos[0]['tamanho']}}</td>  
  <td>{{ ($value->disponibilidade == 1 ? 'Sim' : 'Não')}}</td>  
  <td>{{$value->created_at}}</td>  
  <td>{{$value->updated_at}}</td>  

  <td> <button class='waves-effect red waves-light btn' href="#modal_delete" id="delete-id" data-sabor-id="{{$value->id_pizza}}"><i class="material-icons">delete</i></button></td>
</tr>
  @endforeach 
</tbody>
</table>
<script>
  $(document).on('click','#delete-id',function(){
      var userID=$(this).attr('data-sabor-id');
      $('#pizza_id').val(userID); 
      $('#modal_delete').modal('open'); 
  });
  </script>
@endsection


