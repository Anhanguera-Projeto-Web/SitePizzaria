<html>
  <head> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="https://image.flaticon.com/icons/svg/1384/1384676.svg">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/nav_footer.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="src/css/perfil.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8"/>
</head>
<body>
  <header>
    <nav>
    <div class="nav-wrapper deep-orange">
      <a href="/" class="brand-logo">&nbsp;&nbsp;
        <img class="responsive-img" id="logo" src={{asset('/storage/src/.admin/image/logo/logo.png')}}></a> 
        <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="https://www.coindesk.com/price/bitcoin" target="_blank" rel="noopener noreferrer" id='price-bitcoin'>R$50 = {{ App\Http\Controllers\Admin\PedidosController::getPriceBitcoin()}} <i class="fa fa-btc"></i></a></li>
          <li><a href="/pizzas"><i class="material-icons left">local_pizza</i>Pizzas</a></li>    
        <li><a href="{{route('contact.page')}}"><i class="material-icons left">phone</i>Contato</a></li>
        <li class="divider"></li>
          @if(Auth::guest())
        <li><a href="{{route('login.page')}}"> <i class="material-icons left">person</i>Área do Cliente</a></li>
          @elseif(Auth::user()->nivel == 0)
          <li><a href={{route('perfil.page')}}>{{Auth::user()->nome}}</a></li>
          <li><a href="#!" id='logout-button'><i class="material-icons left">power_settings_new</i></a></li>
          @elseif (Auth::user()->nivel == 1)
        <li><a href='{{route('mod.home.page')}}'><i class="material-icons left">dashboard</i>Dashboard</a></li>
            @elseif (Auth::user()->nivel == 2)
        <li><a href='{{route('admin.home.page')}}'><i class="material-icons left">dashboard</i>Dashboard</a></li>
          @endif
        </ul>
    </nav>

    <ul class="sidenav" id="mobile">
      <li><a href="/" class="brand-logo">&nbsp;&nbsp;CryptoPizza</a></li>
      <li><a href="https://www.coindesk.com/price/bitcoin" target="_blank" rel="noopener noreferrer" id='price-bitcoin'>R$50 = {{ App\Http\Controllers\Admin\PedidosController::getPriceBitcoin()}} <i class="fa fa-btc"></i></a></li>
      <li><a href="/pizzas"><i class="material-icons left">local_pizza</i>Pizzas</a></li>
    <li><a href="{{route('contact.page')}}"><i class="material-icons left">phone</i>Contato</a></li>
            @if(Auth::guest())
        <li><a href="{{route('login.page')}}"> <i class="material-icons left">person</i>Área do Cliente</a></li>
        @elseif (Auth::user()->nivel == 1)
        <li><a href='{{route('mod.home.page')}}'><i class="material-icons left">dashboard</i>Dashboard</a></li>
            @elseif (Auth::user()->nivel == 2)
        <li><a href='{{route('admin.home.page')}}'><i class="material-icons left">dashboard</i>Dashboard</a></li>
          @endif
    </ul>
</header>
  
 <main>
  @yield('content')
</main>
<footer class="page-footer blue">
  <div class="container">
    <div class="row">
  <div class="col l6 s12">
    <h5 class="white-text">Dúvidas</h5>
    <ul>
      <li><a class="grey-text text-lighten-3" href="#!">FAQ</a></li>
      <li><a class="grey-text text-lighten-3" href="{{route('contact.page')}}">Contate-nos</a></li>
    </ul>
    <h5 class="white-text">Siga a gente nas redes sociais</h5>
    <ul>
      <li><a class="grey-text text-lighten-3" href="#!">FAQ</a></li>
    <li><a class="grey-text text-lighten-3" href="#!">Contate-nos</a></li>
    </ul>
  </div>
    <div class="col l4 offset-l2 s12">
    <h5 class="white-text">Avisos Legais</h5>
  <ul>
    <li><a class="grey-text text-lighten-3" href="#!">Termos e Condições</a></li>
    <li><a class="grey-text text-lighten-3" href="#!">Proteção de Dados</a></li>
    <li><a class="grey-text text-lighten-3" href="#!">Política de Privacidade</a></li>
    <li><a class="grey-text text-lighten-3" href="{{route('cookies.page')}}">Política de Cookies</a></li>
  </ul>
  </div>
  <div class="col l4 offset-l2 s12">
    <h5 class="white-text">Criptomoedas aceitas</h5>
  <ul>
    <li><a class="grey-text text-lighten-3">Bitcoin<i class="material-icons left">account_balance_wallet</i></a></li>
  </ul>
  </div>
  </div>
</div>
<div class="footer-copyright blue">
<div class="container">
    © {{now()->year}} {{config('app.name')}}, todos os direitos reservado na Agencia de Restaurantes Online. CNPJ 12.345.678/9012-34/ Avenida Visconde de Itaúna, Niterói/RJ.
  </div>
  </div>
</footer>
    <script src="src/js/nav_footer.js"></script>
</body>
</html>

 
      
   