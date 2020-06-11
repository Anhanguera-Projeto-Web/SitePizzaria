<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends  Authenticatable

{
    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'cpf', 'nome', 'sobrenome','email','passwd', 'id_foto', 'nivel'
    ];

    protected $hidden = [
        'passwd'
    ];

    public function getAuthPassword() {
        return $this->passwd;
    }
    
}
