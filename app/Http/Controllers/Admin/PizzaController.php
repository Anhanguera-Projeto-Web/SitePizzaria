<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Sabor;
use App\Pizza;
use App\Tamanho;
use Validator;
use Image;
use Storage;

class PizzaController extends Controller
{
    private function ruleRegisterSabor(){
        return array(
       'sabor'=>'required | min:1 | max:30 | unique:sabor_pizza',
       'desc_sabor'=>'required | max:50',
   );
   }

   private function ruleRegisterPizza(){
    return array(
   'preco_pizza'=>'required| numeric| between:0,999.99',
   'tamanho' => 'required | max: 1', 
   'sabor' => 'required',
);
}

   private function messages_error(){
       return array(
       'required'=>'O campo :attribute é obrigatório.',
       'max'=>'O campo :attribute ultrapassou o limite de caracteres.',
       'between' => 'O campo :attribute deve estar entre 0 a 999.99',
   );
   }
    public function indexSabor(){
        $data = DB::table('sabor_pizza')->orderBy('sabor')->get();
        return view('arearestrita.admin.pizzas.sabor', compact('data'));
    }

    public function indexPizzas(){
        $data = Pizza::orderBy('id_sabor_pizza')->orderBy('id_tam_pizza')->get();
        return view('arearestrita.admin.pizzas.pizza', compact('data'));
    }
 
    public function criarSabor(){

        return view('arearestrita.admin.pizzas.op.criarsabor');        
    }

    public function criarPizza(){
        $sabor = Sabor::all();
        $tamanho = Tamanho::all();
        return view('arearestrita.admin.pizzas.op.criarpizza', compact('sabor','tamanho'));        
    }

    public function inserirPizza(Request $req){

        $Validador = Validator::make($req->all(), $this::ruleRegisterPizza(), $this::messages_error());
        if($Validador->fails())
          return redirect()->back()->withErrors($Validador->errors())->withInput();

          if($req->hasFile('foto_pizza')){
            $image      = $req->file('foto_pizza');
            $fileName   = request('sabor').'_'.'.png';
    
            $img = Image::make($image->getRealPath());
            $img->resize(680, 440, function ($constraint) {
                $constraint->aspectRatio();                 
            });
    
            $img->stream(); 
    
            Storage::disk('public')->put('src/.admin/image/pizzas/'.$fileName,  $img);
        }
        $Register = Pizza::create([
            'preco_pizza'=> request('preco_pizza'),
            'id_tam_pizza'=> request('tamanho'),
            'id_sabor_pizza' => request('sabor'),
            'disponibilidade' => (request('disponibilidade') ? 1 : 0)
        ]);
  
        return redirect()->route('admin.pizzas.page');

    }

    public function inserirSabor(Request $req){
       
        $Validador = Validator::make($req->all(), $this::ruleRegisterSabor(), $this::messages_error());
        if($Validador->fails())
          return redirect()->back()->withErrors($Validador->errors())->withInput();
    
        $Register = Sabor::create([
            'sabor'=> request('sabor'),
            'desc_sabor'=> request('desc_sabor'),
        ]);

        return redirect()->route('admin.sabores.page');
   }

    public function deletarSabor(Request $req){
        $dados = $req->all();
       
        Sabor::destroy($dados['id_sabor']);
        return redirect()->route('admin.sabores.page');
    }

    public function deletarPizza(Request $req){
        $dados = $req->all();
       
        Pizza::destroy($dados['id_pizza']);
        return redirect()->route('admin.pizzas.page');
    }
}
