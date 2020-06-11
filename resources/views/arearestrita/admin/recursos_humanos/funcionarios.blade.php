@extends('arearestrita.layouts.sidebar')
<nav style='padding-left: 22rem;'  class="deep-orange">
  <div class="nav-wrapper">
    <div class="col s12">
    <a href="{{route('admin.home.page')}}" class="breadcrumb">Dashboard</a>
    <a href="{{route('admin.func.page')}}" class="breadcrumb">Funcionários</a>
    </div>
  </div>
</nav>
@section('content')
<div id="modal_delete" class="modal" style= "width: 35%; heighth: 20%;">
  <div class="modal-content  grey lighten-4">
    <form action="{{route('admin.deletar.func')}}" method="POST" class="remove-record-model">
      {{ method_field('delete') }}
      {{ csrf_field() }}
    <h4 class="center-align">Você deseja deletar este usuário?</h4>
    <p class="center-align red-text">Essa ação não pode ser desfeita.</p>
  </div>
  <div class="modal-footer  grey lighten-2">
    <input type="hidden" name="id_func" id="app_id">
    <button class="btn red darken-2" type="submit" name="action">Deletar<i class="material-icons left">delete</i></button>
    <a class="modal-close waves-effect waves btn-flat"><i class="material-icons left">cancel</i>Cancelar</a>
  </form>
  </div>
</div>
<div class="fixed-action-btn">
  <a class="btn-floating btn-large green" href="{{route('admin.criar.func')}}">
      <i class="large material-icons">add</i>
    </a>
</div>
  @if(Session::has('Success'))
    <div id="card-alert" class="card green lighten-5">
        <div class="card-content green-text">
        <p align="center">{{Session::get('Success')}}</p>
        </div>
    </div>
    <br>
    @endif
    @if(Session::has('Error'))
    <div id="card-alert" class="card red lighten-5">
        <div class="card-content red-text">
        <p align="center">{{Session::get('Error')}}</p>
        </div>
    </div>
    <br>
    @endif
<table class="responsive-table highlight">
  <thead>
    <tr>
        <td>ID</td>
        <td>Foto</td>
        <td>Nome</td>
        <td>E-mail</td>
        <td>CPF</td>
        <td>Nível</td>
        <td>Criado em</td>
        <td>Funções</td>
    </tr>
</thead>
<tbody>
  @foreach($data as $value)
  <tr>
      <td>{{$value->id_usuario}}</td>
      <td><img src="{{asset('/storage/src/.admin/image/funcionarios/'.$value->id_foto.'.jpg')}}" style="width: 100px; height: 100px;  border-radius: 50%;"></td>
      <td>{{$value->nome}} {{$value->sobrenome}}</td>
      <td>{{$value->email}}</td>
      <td>{{$value->cpf}}</td>
      <td>{{($value->nivel == 2 ? 'Admin' : 'Moderador')}}</td>
      <td>{{$value->created_at}}</td>
      <td>
      <a class="btn waves-effect waves-light" href="{{route('admin.att.func')}}/{{$value->id_usuario}}"><i class="large material-icons">create</i>
        </a>
        &nbsp;
      <button class='waves-effect red waves-light btn' href="#modal_delete" id="delete-id" data-func-id="{{$value->id_usuario}}"><i class="material-icons">delete</i></button>
      </td>
  </tr>
  @endforeach 
</tbody>
</table>
<script>
  $(document).on('click','#delete-id',function(){
      var userID=$(this).attr('data-func-id');
      $('#app_id').val(userID); 
      $('#modal_delete').modal('open'); 
  });
  </script>
@endsection

