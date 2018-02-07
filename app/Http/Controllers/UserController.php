<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\RegisterFormRequest;
use App\User;
use Crypt;

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
    // 
    public function novo_user(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|numeric',
            'data_nasc' => 'required|date',
            'data_admi' => 'required|date',
            'endereco' => 'required',
            'fone' => 'required|numeric',
            'cel' => 'required|numeric',
            'role' => 'required',
        ],[
            'name.required' => 'O Campo Nome Não Pode ser Vazio',
            'name.max' => 'O Campo permite Somente 255 Caracteres',
            'email.required' => 'O Campo E-mail Não Pode ser Vazio',
            'email.email' => 'Não é um E-mail Válido',
            'email.unique:users' => 'Esse E-mail já está sendo utilizado',
            'password.required' => 'O Campo CPF Não Pode ser Vazio',
            'password.min:11' => 'Não pode ser menor que 11 digitos',
            'password.max:11' => 'Não pode ser maior que 11 digitos',
            'password.unique:users' => 'CPF já se encontra-se utilizado',
            'data_nasc.required' => 'O Campo Data de Nascimento Não Pode ser Vazio',
            'data_nasc.date' => 'Valor inserido é inválido',
            'data_admi.required' => 'O Campo Data de Admissão Não Pode ser Vazio',
            'data_admi.date' => 'Valor inserido é inválido',
            'endereco.required' => 'Não campo Endereço Não Pode ser Vazio',
            'endereco.max:100' => 'Apenas 100 Caracteres para o Campo Endereço',
            'fone.required' => 'O Campo Telefone não pode ser vazio',
            'fone.min:10' => 'Não pode ser inferior a 11 Caracteres',
            'fone.max:10' => 'Não pode ser superior a 11 Caracteres',
            'cel.required' => 'O Campo Celular não pode ser vazio',
            'cel.min:11' => 'Não pode ser inferior a 11 Caracteres',
            'cel.max:11' => 'não pode ser superior a 11 Caracteres',
            'role.required' => 'Escolha uma Opção',
        ]);
        $usuario = new User($request->all());
        $usuario->password = Crypt::encrypt($request->input('password'));
        $usuario->save();
        return redirect('registrar_usuario')->with('mensagens-sucesso','Cadastrado com sucesso');

    }
}
