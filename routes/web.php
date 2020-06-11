<?php

use Illuminate\Support\Facades\Route;
use App\Sabor;
use App\Pizza;
use Vrajroham\LaravelBitpay\LaravelBitpay;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HOME PAGE

    Route::get('/',['as'=>'home.page', function(){
        $pizza = Pizza::where('disponibilidade',1)->groupBy('id_sabor_pizza')->get();
        return view('index', compact('pizza'));
    }]);

    Route::post('/',['as'=>'add.pizza','uses'=>'ClienteController@addPizza']);


//ROTAS PARA FAQ, COOKIES, POLITICAS
    Route::get('/cookies',['as'=>'cookies.page',function(){
        return view('info.cookies');
    }]);

//ROTAS PARA CONTATO
    Route::get('/contato', ['as'=>'contact.page', 'uses'=>'ContactController@index']);
    Route::post('/enviarmensagem',['as'=>'contacting.page','uses'=>'ContactController@enviarMensagem']);

//ROTAS PARA LOGIN
    Route::get('/login', ['as'=>'login.page','uses'=>'UsuarioController@loginpage']);
    Route::post('/logging', ['as'=>'logging.page', 'uses'=>'UsuarioController@logging']);
    Route::get('/logout', ['as'=>'logout.page', 'uses'=>'UsuarioController@logout']);

//ROTAS PARA CADASTRO
    Route::get('/registro', ['as' => 'register.page','uses'=>'UsuarioController@registropage']);
    Route::post('/registrar', ['as' =>'registering.page', 'uses'=>'UsuarioController@validarRegistro']);

//ROTAS PARA PIZZAS
    Route::get('/pizzas', ['as'=>'pizzas.page', 'uses'=>'UsuarioController@pizzaspage']);

//ROTAS INVOICE
    Route::get('/invoice', ['as'=>'invoice.page','uses'=>'ClienteController@invoicepage']);

//VISÃO RESTRITA
Route::group(['middleware'=>'auth'], function(){ 

    Route::get('/perfil', ['as'=>'perfil.page','uses'=>'ClienteController@indexperfil']);
    Route::get('/payment', ['as'=>'payment.page','uses'=>'ClienteController@payment']);
    
    Route::get('/arearestrita', function(){return redirect()->route('home.page');});

    //VISÃO RESTRITA PARA ADMIN
    Route::group(['middleware'=>'adminAuth'], function(){

        //VISÃO GERAL
        Route::get('/arearestrita/admin', ['as' => 'admin.home.page', 'uses'=>'Admin\AdminController@homepage']);
        Route::get('/arearestrita/admin/clientes',['as'=>'admin.cliente.page', 'uses'=> 'Admin\AdminController@indexCliente']);
        Route::get('/arearestrita/admin/funcionarios',['as'=>'admin.func.page', 'uses'=> 'Admin\AdminController@indexFuncionario']);
        Route::get('/arearestrita/admin/mensagens',['as'=>'admin.mensagens.page', 'uses'=> 'Admin\AdminController@indexMensagens']);
        
        Route::get('/arearestrita/admin/sabores', ['as'=>'admin.sabores.page', 'uses'=> 'Admin\PizzaController@indexSabor']);
        Route::get('/arearestrita/admin/pizzas', ['as'=>'admin.pizzas.page', 'uses'=> 'Admin\PizzaController@indexPizzas']);

        // FUNCIONÁRIOS
        Route::get('/arearestrita/admin/funcionarios/criarfunc', ['as'=>'admin.criar.func', 'uses'=> 'Admin\AdminController@criarFunc']);
        Route::post('/arearestrita/admin/funcionarios/criarfunc', ['as'=>'admin.criar.func', 'uses'=> 'Admin\AdminController@inserirFunc']);
        Route::delete('arearestrita/admin/funcionarios/deletarfunc',['as'=>'admin.deletar.func', 'uses'=> 'Admin\AdminController@deletarFunc']);
        Route::get('/arearestrita/admin/funcionarios/atualizarfunc/{id}', ['as'=>'admin.att.func', 'uses'=> 'Admin\AdminController@retornaFunc']);
        Route::put('/arearestrita/admin/funcionarios/atualizarfunc', ['as'=>'admin.att.func', 'uses'=> 'Admin\AdminController@atualizarFunc']);

        // SABORES
        Route::get('/arearestrita/admin/sabores/criarsabor', ['as'=>'admin.criar.sabor', 'uses'=> 'Admin\PizzaController@criarSabor']);
        Route::post('/arearestrita/admin/sabores/criarsabor', ['as'=>'admin.criar.sabor', 'uses'=> 'Admin\PizzaController@inserirSabor']);
        Route::delete('arearestrita/admin/sabores/deletarsabor',['as'=>'admin.deletar.sabor', 'uses'=> 'Admin\PizzaController@deletarSabor']);

        // PIZZAS
        Route::get('/arearestrita/admin/pizzas/criarpizza', ['as'=>'admin.criar.pizza', 'uses'=> 'Admin\PizzaController@criarPizza']);
        Route::post('/arearestrita/admin/pizzas/criarpizza', ['as'=>'admin.criar.pizza', 'uses'=> 'Admin\PizzaController@inserirPizza']);
        Route::delete('arearestrita/admin/pizzas/deletarpizza',['as'=>'admin.deletar.pizza', 'uses'=> 'Admin\PizzaController@deletarPizza']);



        # Não implementadas por motivos de não serem cruciais para o sistema, ainda.
        // Route::get('/arearestrita/admin/pedidos', ['as'=>'admin.criar.func', 'uses'=> 'Admin\PizzaController@criarFunc']);
        // Route::get('/arearestrita/admin/relatorio', ['as'=>'admin.criar.func', 'uses'=> 'Admin\PizzaController@criarFunc']);
        // Route::get('/arearestrita/admin/documentacao', ['as'=>'admin.criar.func', 'uses'=> 'Admin\PizzaController@docs']);
        // Route::get('/arearestrita/admin/rastreio', ['as'=>'admin.criar.func', 'uses'=> 'Admin\PizzaController@rastreio']);


    });
    
        //VISÃO RESTRITA PARA MODERADORES
        Route::group(['middleware'=>'modAuth'], function(){
            Route::get('/arearestrita/moderador', ['as'=>'mod.home.page', 'uses'=> 'Admin\ModController@homepage']);
    
    });

});

  