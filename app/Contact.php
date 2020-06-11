<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
   protected $fillable = [
    'assunto','titulo_contato','cep','cidade','logradouro','nome_requerente','mail_requerente','cpf_requerente','txt_chamado'
   ];

   protected $table = 'contatos';
}
