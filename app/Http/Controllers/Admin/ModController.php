<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModController extends Controller
{
    public function homepage(){
        return view('arearestrita.moderador.index');
}
}
