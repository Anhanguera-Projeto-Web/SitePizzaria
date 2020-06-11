@extends('layouts.header.navbar')
<title>{{config('app.name')}} - Cookies</title>

@section('content')
<br><br>
<style type="text/css">
	.btn{
		margin-top: 10px;
	}
	#container-form{
		margin:100px auto;
		width: 80%;

	}
	@media(max-width: 952px){
		.container{
			width: 60%;
		}
	}
		@media(max-width: 475px){
		.container{
			width: 90%;
		}
	}
</style>
<div class="container" id="container-form">
	<div class="row card hoverable">
		<div class="card-content z-depth-4">
        <h3 class="center blue-text">O que é um Cookie?</h3>
        <p>Um cookie é um arquivo temporário armazenado no navegador do usuário 
            recebido de determinadas páginas Web para acelerar e recuperar informações na aplicação.</p>
        <p>Nossos Cookies são criptografados e separados em sub-cookies para intensificar a segurança, além disso, provêmos ferramentas
            contra a invasão de sessões e encriptamos a sessão para garantir que o usuário navegue de forma segura em nosso site. </p>

		<h3 class="center blue-text">Política de Cookies</h3>
		<p>A {{config('app.name')}} utiliza Cookies próprios e de terceiros para melhorar os nossos serviços e mostrar publicidade relacionada 
            com as preferências dos utilizadores mediante análise de hábitos de navegação. 
            Ao continuar navegar, considera-se automaticamente que o usuário <b>aceita</b> o uso de Cookies. </p>
        <p>Bloquear ou restringir os Cookies pode causar problemas de execução no site.</p>
        
        <h3 class="center blue-text">Posso desabilitar os Cookies?</h3>
        <p>Infelizmente não :( A {{config('app.name')}} trabalha com Cookies criptografados para manter a segurança dos dados. Bloquear os Cookies ppoderá trazer complicações
        para a sua navegação. Caso queira excluir seus Cookies do navegador, sinta-se livre, mas lembre-se, você perderá o acesso de sessão a sua conta, além do carrinho de compras das pizzas
        e limpará suas abas de contato.</p>

        <h3 class="center blue-text">Dúvidas?</h3>
        <p>Caso tenha alguma dúvida, <a href="{{route('contact.page')}}">clique aqui</a> para entrar em contato com a {{config('app.name')}}!</p>
        <br>
		</div>
	</div>
</div>

<script src="/src/js/contato.js"></script>
<br><br>
@endsection



