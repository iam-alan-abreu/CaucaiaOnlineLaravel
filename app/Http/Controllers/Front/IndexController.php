<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){

      $titulo = 'Seja Bem-vindo(a).';
      return view('front.index', compact('titulo'));
    }
}
