<?php

namespace App\Http\Controllers;

use Validator;
use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller{

    private function rules(){
       return array(
            'assunto'=>'required',
            'cpf_requerente'=>'required | min:11| max:11',
            'mail_requerente'=>'required |email| max:254',
            'nome_requerente'=>'required | min:1| max:50',
            'titulo_contato'=>'required |max:100',
            'cep'=>'max:8 | min:8',
            'cidade' => 'required | min:1 ',
            'logradouro'=>'required |min:1 ',
            'txt_chamado'=>'required | min:1| max:16912',
       );
}

private function messages_error(){
    return array(
    'required'=>'O campo :attribute é obrigatório.',
    'cep.min'=>'O campo CEP deve ser preenchido com os 8 dígitos.',
    'txt_chamado.required'=>'O corpo do chamado não pode permanecer vazio.',
    'regex'=>'O campo :attribute não possuí as exigências para ser aceito em nossos bancos, verifique os dados digitados.',
    'unique'=>'O :attribute já foi utilizado, tente outro.'
);
}

    public function index(){
        return view('contato.index');
    }

    public function enviarMensagem(Request $req){
       
        $Validador = Validator::make($req->all(), $this::rules(), $this::messages_error());

        if($Validador->fails()){
            return redirect()->back()->withErrors($Validador->errors())->withInput();
          }
            Contact::create($req->all());
            return redirect()->back()->with('success','Sucesso ao enviar!');
           
    }
}
