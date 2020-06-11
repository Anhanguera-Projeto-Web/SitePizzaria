@extends('layouts.header.navbar')
<title>{{config('app.name')}} - Perfil</title>
<link rel="stylesheet" href="src/css/perfil.css">
@section('content')
    <div class="container"> 
        <div class="row">
        <div class="col s12">  
            <h2>Bem-vindo ao seu perfil, {{Auth::user()->nome}}</h2></div>
        </div>
      
    <div class="row">
        <div class="col push s12">
            <ul class="collapsible popout">
                <li class='active'>
                  <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
                  <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
                  <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
                  <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>          
                </li>
              </ul>
    </div>
    </div>
</div>
<br><br>
@endsection


