@extends('arearestrita.layouts.sidebar')
<nav style='padding-left: 22rem;' class="deep-orange">
  <div class="nav-wrapper">
    <div class="col s12">
    <a href="{{route('admin.home.page')}}" class="breadcrumb">Dashboard</a>
    <a href="{{route('admin.cliente.page')}}" class="breadcrumb">Clientes</a>
    </div>
  </div>
</nav>

@section('content')
<table class="responsive-table highlight">
  <thead>
    <tr>
        <td>ID</td>
        <td>Nome</td>
        <td>E-mail</td>
        <td>CPF</td>
        <td>Criado em</td>
    </tr>
</thead>
<tbody>
 
  @foreach($data as $value)
  <tr>
      <td>{{$value->id_usuario}}</td>
      <td>{{$value->nome}}</td>
      <td>{{$value->email}}</td>
      <td>{{$value->cpf}}</td>
      <td>{{$value->created_at}}</td>
  </tr>
  @endforeach 
</tbody>
</table>
@endsection