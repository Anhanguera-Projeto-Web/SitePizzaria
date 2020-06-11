@extends('layouts.header.navbar')
<title>{{config('app.name')}} - Pizzas</title>
@include('layouts.header.cart')

@section('content')
<br><br>
<div class="container"> 
    <h2>Pizzas Disponíveis</h2>
    @foreach($sabor as $value)
    <div class="row">
      <div class="col s4 m4">
          <div class="card z-depth-3">
            <div class="card-image">
              <img src={{asset('/storage/src/.admin/image/pizzas/'.$value->id_sabor.'_.png')}}> 
            <span class="card-title">{{$value->sabor}}</span>
              <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
            </div>
            <div class="card-content">
            <p>{{$value->desc_sabor}}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div><br><br>
</div>
<br>
@endsection
