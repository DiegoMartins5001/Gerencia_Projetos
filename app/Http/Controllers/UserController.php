<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
    	return view('entrada.entrada');
    }
    public function index_dev(){
        return view('entrada.dev_entrada');
    }

    public function form_user(){
    	return view('auth.register');
    }

    public function novo_user(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|numeric',
            'data_nasc' => 'required|date',
            'data_admi' => 'required|date',
            'endereco' => 'required',
            'fone' => 'numeric',
            'cel' => 'numeric',
            'role' => 'required',
        ]);

        $usuario = new User($request->all());
        $usuario->save();
        return redirect('registrar_usuario')->with('mensagens-sucesso','Cadastrado com sucesso');

    }
}
