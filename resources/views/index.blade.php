@extends('layouts.header.navbar')
<title>{{config('app.name')}}</title>
@section('content')

@include('layouts.header.carousel')
@include('layouts.header.cart')
<div class="container"> 
    <h2>{{config('app.name')}}</h2>
      <h4>A primeira pizzaria a aceitar criptomoedas</h4>
      <?php Cart::session(Session::getId()); ?>
    @foreach($pizza as $value)
    <div class="row">
    <form action={{route('add.pizza')}} method='post' id='pizza_form_{{$value->sabores[0]['id_sabor']}}'>
        @csrf
      <div class="col s4 m4">
          <div class="card z-depth-3">
            <div class="card-image">
              <img class='responsive-img' src={{asset('/storage/src/.admin/image/pizzas/'.$value->sabores[0]['id_sabor'].'_.png')}}> 
            <span class="card-title">{{$value->sabores[0]['sabor']}}</span>
                <input type='hidden' value={{$value->sabores[0]['id_sabor']}} name='id_sabor'/>
                <input type='hidden' value={{$value->sabores[0]['sabor']}} name='sabor'/>
            </div>
            <div class="card-content">
            <p style='text-align: center'>{{$value->sabores[0]['desc_sabor']}}</p>
            <p style='text-align: center'>A partir de: R${{$value->preco_pizza}}</p>
            </div>
            <div class="card-action center-align  blue darken-2">
            <a href="#" onClick="document.getElementById('pizza_form_{{$value->sabores[0]['id_sabor']}}').submit();">Adicionar ao Carrinho</a>
            </div>
          </div>
        </div>
      </form>
        @endforeach
    </div>  
</div>
<br><br>
<br><br>
@endsection