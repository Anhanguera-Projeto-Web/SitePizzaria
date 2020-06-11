//Home Page
$(document).ready(function(){
    $('.carousel').carousel({
        fullWidth:true,
        indicators:true,
        autoplay: true
    }).height(400);
    setInterval(function() {
        $('.carousel').carousel('next');
      }, 4000);
  });

//Limite 11 Caracteres CPF - Login
$(document).ready(function() {
  $('input#input_cpf').characterCounter();
});

//Inicializando o NavBar Mobile
  $(document).ready(function(){
    $('.sidenav').sidenav();
    $('#dropdown-trigger-mobile').dropdown();
    $('#dropdown-trigger-normal').dropdown();
   
  });
  
  $('#logout-button').click(function(){
    $.confirm({
      title: 'Logout',
      icon: 'fa fa-warning',
      content: 'Você está saindo da CryptoPizza, gostaria realmente de <strong>sair</strong>?',
      type: 'red',
      theme: 'dark',
      boxWidth: '400px',
      useBootstrap: false,
      typeAnimated: true,
      buttons: {
          yes: {
              text: 'Sim',
              btnClass: 'btn-red',
              action: function(){
                window.location.replace("/logout");
              }
          },
          close: {
          text: 'Não',
          action: function () {
          
          }
        }
      }
    });    
  });

M.AutoInit();