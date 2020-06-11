@extends('layouts.header.navbar')
<title>{{config('app.name')}}</title>

@section('content')
<br><br>
<?php Cart::session(Session::getId());
$GLOBALS['total'] = 0;?>

<div class="container"> 
    <h2>{{config('app.name')}}</h2>
      <div class="row card hoverable">
        <div class="card-content z-depth-4">
        <h3 class="center blue-text">Invoice</h3>
        
            <br>
            <table>
              <thead>
                  <tr>
                      <th>Pizza</th>
                      <th>Quantidade</th>
                      <th>Sub-total</th>
                      <th>Preço</th>
                  </tr>
              </thead>
         
              <tbody>
                @foreach($crt as $row)
                  <?php $GLOBALS['total'] += floatval($row->price*$row->quantity); ?>
                    <tr>
                        <td>
                            <p><strong>{{$row->name}}</strong></p>
                            <p></p>
                        </td>
                        <td> {{$row->quantity}} </td>
                        <td> {{$row->price}} </td>
                        <td> {{$row->price * $row->quantity}}  </td>
  
                    </tr>
         
               @endforeach
         
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2">&nbsp;</td>
                  <td>Total</td>
                  <td>{{$GLOBALS['total']}}</td>
                </tr>
              </tfoot>
         </table>
      
        </div>
      </div>
      <div class="col s12 right">
        <button class="btn-large waves-effect waves-light" type="submit">Comprar pizzas
          <i class="fa fa-cart-arrow-down"></i>
        </button>
    </div>
    </div>
    
      <br><br>
      <br><br>
     
</div>
@endsection


