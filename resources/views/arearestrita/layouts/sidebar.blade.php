<!DOCTYPE html>
<html lang="en">
<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="/storage/src/.admin/css/nav_footer.css">
    <link rel="icon" href="https://image.flaticon.com/icons/svg/1384/1384676.svg">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8"/>
  <title>{{config('app.name')}} - Painel</title>
</head>
<body>
  <ul id="slide-out" class="sidenav sidenav-fixed">
    <li><div class="user-view">
      <div class="background">
        <img src="/src/image/background/wood.jpg" style="max-heigth: 110%; max-width: 130%;">
      </div>
      
    <a><img class="circle" src="/storage/src/.admin/image/funcionarios/{{Auth::user()->id_foto}}.jpg"></a>

      <a><span class="white-text name">{{(Auth::user()->nome)}} {{(Auth::user()->sobrenome)}}</span></a>
      <a><span class="white-text email"><i>{{(Auth::user()->email)}} </i></span></a>
    </div></li>
  <li><a href="{{route('admin.home.page')}}"><i class="material-icons">dashboard</i> Dashboard</a></li>
    <li class="divider"></li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header">Recursos Humanos<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
            <li><a href="{{route('admin.cliente.page')}}"><i class="material-icons">person</i> Clientes</a></li>
              <li><a href="{{route('admin.func.page')}}"><i class="material-icons">assignment_ind</i> Funcionários</a></li>
            <li><a href="{{route('admin.mensagens.page')}}"><i class="material-icons">message</i>Mensagens</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
   
    <li class="divider"></li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header">Pizzas<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
            <li><a href="{{route('admin.sabores.page')}}"><i class="material-icons">restaurant</i>Sabores</a></li>
              <li><a href="{{route('admin.pizzas.page')}}"><i class="material-icons">local_pizza</i>Pizzas</a></li>
              <li><a href="#!"><i class="material-icons">attach_money</i>Promoções</a></li>
              <li><a href="#!"><i class="material-icons">data_usage</i> Pedidos</a></li>
              <li><a href="#!"><i class="material-icons">content_paste</i> Gerar relatório</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>

    <li class="divider"></li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header">Ferramentas<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="#!"><span class = "badge">Beta</span><i class="material-icons">location_on</i>Rastreio</a></li>
              <li><a href="#!"><i class="material-icons">book</i>Documentação</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
    <li class="divider"></li>
    <li><a href="{{route('home.page')}}"><i class="material-icons left">home</i>Página Inicial</a></li>
    <li><a href="{{route('logout.page')}}"><i class="material-icons left">power_settings_new</i>Sair</a></li>
  </ul>
  <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
<main>
  @yield('content')
</main>
 <script>M.AutoInit();</script>  
</body>
</html>
  
   
        
     

 