<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Hash;
use App\Sabor;
use App\Pizza;

class UsuarioController extends Controller{


// REGRAS
    private function rulesRegister(){
        return array(
        'cpf'=>'required | min:11 | max:11 | cpf | unique:usuarios',
        'nome'=>'required | max:40',
        'sobrenome'=>'required | max:50',
        'email'=>'required | email| max:254| unique:usuarios',
        'passwd'=>['required','min:8','max:32','not_regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$]/'],
        'passwd_confirmation'=>['required','min:8','max:32','not_regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$]/','same:passwd'],
        'confirmaTermos' => 'accepted | required ',
        'confirmaPolitica'=>'accepted | required '
    );
    }
    private function rulesLogin(){
        return array(
        'cpf'=>'required | min:11 | max:11',
        'passwd'=>['required','min:8','max:32','not_regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$]/'],
    );
    }

    private function messages_error(){
        return array(
        'required'=>'O campo :attribute é obrigatório.',
        'min'=>'O campo :attribute não possuí a quantidade mínima/certa de caracteres.',
        'regex'=>'O campo :attribute não possuí as exigências para ser aceito em nossos bancos, verifique os dados digitados.',
    );
    }

    public function loginpage(){
        if(Auth::check())
            return redirect()->route('home.page');
        else
            return view('login.index');
    }

    public function registropage(){
        return view('registro.index');
    }

    public function pizzaspage(){
        $sabor = Sabor::get();
        $pizza = Pizza::where('disponibilidade',1)->get();
        return view('pizzas.index',compact('sabor','pizza'));
    }

// AUTENTICAÇÃO DE REGISTRO DE USUÁRIO

    public function validarRegistro(Request $req){
   
        $Validador = Validator::make($req->all(), $this::rulesRegister(), $this::messages_error());
        
      if($Validador->fails()){
      return redirect()->back()->withErrors($Validador->errors())->withInput();
    }
        $Register = User::create([
            'cpf'=> request('cpf'),
            'nome'=> request('nome'),
            'sobrenome'=> request('sobrenome'),
            'email' => request('email'),
            'passwd' => Hash::make(request('passwd')),
        ]);

    return redirect()->route('login.page');
}  

    public function logging(Request $req){

        $dados = $req->all();

        $Validador = Validator::make($dados, $this::rulesLogin(), $this::messages_error());
        
        if($Validador->fails())
           return redirect()->route('login.page')->with('Error', 'Os campos não foram preenchidos corretamente, tente novamente.');


        if(Auth::attempt(['cpf'=>$dados['cpf'],'password'=>$dados['passwd']], True))
            return redirect()->route('home.page');
        else    
            return redirect()->route('login.page')->with('Error', 'CPF ou Senha Incorretos');
    }   

    public function logout(){
        Auth::logout();
        return redirect()->route('home.page');
    }
}