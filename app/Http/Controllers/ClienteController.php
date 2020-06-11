<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Session;
use App\Sabor;
use App\Pizza;

class ClienteController extends Controller{
    
    public function indexperfil(){
        return view('login.perfil');
    }

    public function addPizza(Request $req){

        $pizza = Pizza::where('id_sabor_pizza',$req->all()['id_sabor'])->get()->first();

        Cart::add([
            'id' => $pizza->id_pizza,
            'name' => $req->all()['sabor'],
            'price' => $pizza->preco_pizza,
            'quantity' => 1
            ]);
        return redirect()->back();
    }

    public function invoicepage(){
        $crt = Cart::getContent();
     
        return view('invoice.index', compact('crt'));
    }
}
