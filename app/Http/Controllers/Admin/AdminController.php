<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Validator;
use Image;
use Storage;
use App\User;
use Hash;
use DB;

class AdminController extends Controller
{
        private function rulesRegister(){
         return array(
        'cpf'=>'required | min:11 | max:11 |cpf| unique:usuarios',
        'nome'=>'required | max:40',
        'sobrenome'=>'required | max:50',
        'email'=>'required | email| max:254| unique:usuarios',
        'passwd'=>['required','min:8','max:32','not_regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$]/'],
        'passwd_confirmation'=>['required','min:8','max:32','not_regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$]/','same:passwd'],
        'nivel' => 'required ',
        'foto_id'=>'required | image'
    );
    }
    private function rulesUpdate(){
        return array(
       'nome'=>'required | max:40',
       'sobrenome'=>'required | max:50',
       'email'=>'required | email| max:254',
       'nivel' => 'required',
       'foto_id' => 'image'
   );
   }

    private function messages_error(){
        return array(
        'required'=>'O campo :attribute é obrigatório.',
        'min'=>'O campo :attribute não possuí a quantidade mínima/certa de caracteres.',
        'regex'=>'O campo :attribute não possuí as exigências para ser aceito em nossos bancos, verifique os dados digitados.',
        'mimes' => 'O campo de foto deve ter o formato: JPEG ou JPG.'
    );
    }
 
    public function homepage(){
            return view('arearestrita.admin.dashboard');
    }

    public function indexCliente(){
            $data = DB::table('usuarios')->where('nivel', '=', '0')->orderBy('created_at')->get();
            return view('arearestrita.admin.recursos_humanos.clientes', compact('data'));
    }

    public function indexFuncionario(){
            $data = DB::table('usuarios')->where('nivel', '>', '0')->orderBy('nivel','DESC')->get();
        return view('arearestrita.admin.recursos_humanos.funcionarios', compact('data'));}
    public function indexMensagens(){
            $data = DB::table('contatos')->orderBy('created_at')->get();
            return view('arearestrita.admin.recursos_humanos.contato', compact('data'));}

    public function criarFunc(){
        return view('arearestrita.admin.recursos_humanos.op.criarfunc');}

    public function inserirFunc(Request $req){
        $Validador = Validator::make($req->all(), $this::rulesRegister(), $this::messages_error());
        
      if($Validador->fails())
        return redirect()->back()->withErrors($Validador->errors())->withInput();
    
      if($req->hasFile('foto_id')){
        $image      = $req->file('foto_id');
        $fileName   = request('nome').'_'.request('cpf').'_'.request('sobrenome'). '.jpg';

        $img = Image::make($image->getRealPath());
        $img->resize(130, 130, function ($constraint) {
            $constraint->aspectRatio();                 
        });

        $img->stream(); 

        Storage::disk('public')->put('src/.admin/image/funcionarios/'.$fileName,  $img);
    }

        $id_foto = request('nome').'_'.request('cpf').'_'.request('sobrenome');
        $Register = User::create([
            'cpf'=> request('cpf'),
            'nome'=> request('nome'),
            'sobrenome'=> request('sobrenome'),
            'email' => request('email'),
            'passwd' => Hash::make(request('passwd')),
            'nivel' => request('nivel'),
            'id_foto' =>  $id_foto
        ]);
    return redirect()->route('admin.func.page');
} 

    public function deletarFunc(Request $req){
        $dados = $req->all();
        $image = DB::table('usuarios')->where('id_usuario', $dados['id_func'])->first();
        if(Auth::user()->id_usuario == (int)$dados['id_func'])
            return redirect()->route('admin.func.page')->with('Error','Você não tá tentando se deletar não né?');

        User::destroy($dados['id_func']);
        Storage::disk('public')->delete('src/.admin/image/funcionarios/'.$image->id_foto.'.jpg');

            return redirect()->route('admin.func.page')->with('Success','Usuário deletado');
        }

    public function retornaFunc($id){
        $data = DB::table('usuarios')->where('id_usuario', $id)->get();
        return view('arearestrita.admin.recursos_humanos.op.atualizarfunc', compact('data'));
    }
    
    public function atualizarFunc(Request $req){
        $Validador = Validator::make($req->all(), $this::rulesUpdate(), $this::messages_error());
        if($Validador->fails())
            return redirect()->back()->withErrors($Validador->errors())->withInput();
      
        
        $dados = DB::table('usuarios')->where('id_usuario', $req->all()['id_usuario'])->first();
        if ($req->hasFile('foto_id')){
          $image      = $req->file('foto_id');
          $fileName   = request('nome').'_'.$dados->cpf.'_'.request('sobrenome').'.jpg';
  
          $img = Image::make($image->getRealPath());
          $img->resize(130, 130, function ($constraint) {
              $constraint->aspectRatio();                 
          });
  
          $img->stream(); 
  
          Storage::disk('public')->put('src/.admin/image/funcionarios/'.$fileName,  $img);}
  
          $id_foto = request('nome').'_'.$dados->cpf.'_'.request('sobrenome');
          DB::table('usuarios')->where('id_usuario', $req->all()['id_usuario'])->update([
              'nome'=> request('nome'),
              'sobrenome'=> request('sobrenome'),
              'email' => request('email'),
              'nivel' => request('nivel'),
              'id_foto' =>  $id_foto
          ]);
  
      return redirect()->route('admin.func.page');
    }
}
