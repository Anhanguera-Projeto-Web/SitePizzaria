@extends('arearestrita.layouts.sidebar')
<nav style='padding-left: 22rem;'  class="deep-orange">
  <div class="nav-wrapper">
    <div class="col s12">
    <a href="{{route('admin.home.page')}}" class="breadcrumb">Dashboard</a>
    <a href="{{route('admin.mensagens.page')}}" class="breadcrumb">Mensagens</a>
    </div>
  </div>
</nav>
@section('content')
<table class="responsive-table highlight">
  <thead>
     
    <tr>
        <td>ID</td>
        <td>Assunto</td>
        <td>Título</td>
        <td>Requerente</td>
        <td>Cidade</td>
        <td>E-mail</td>
        <td>Criado em</td>
        <td>Alterado em</td>
        <td>Lido?</td>
    </tr>
</thead>
<tbody>
  @foreach($data as $value)
 <tr>
        <td>{{$value->id_contato}}</td>
        <td>
        @switch($value->assunto)
    @case(1)
        <span>Informação</span>
    @break

    @case(2)
        <span>Reclamação/Crítica/Feedback</span>
    @break

    @case(3)
        <span>Problemas Financeiros</span>
    @break

    @case(4)
        <span>Problemas com minha conta</span>
    @break

    @case(5)
        <span>Outro(s)</span>
    @break @default <span> -/- </span> @endswitch       
    </td>
        <td>{{$value->titulo_contato}}</td>
        <td>{{$value->nome_requerente}}</td>
        <td>{{$value->cidade}}</td>
        <td>{{$value->mail_requerente}}</td>
        <td>{{$value->created_at}}</td>
        <td>{{$value->updated_at}}</td>
        <td><i class="small material-icons">{{($value->lido == 'nao' ? "cancel" : 'check')}}</i></td>
      </tr>
  @endforeach 
</tbody>
</table>
<ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
</ul>

<script>
    $(document).ready(function(){
    $('.collapsible').collapsible();
  });
</script>
@endsection


