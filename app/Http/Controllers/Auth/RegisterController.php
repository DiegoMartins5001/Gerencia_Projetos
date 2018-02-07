<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RegisterFormRequest;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:11|max:11|confirmed|unique:users',
            'data_nasc' => 'required|date',
            'data_admi' => 'required|date',
            'endereco' => 'required|max:100',
            'fone' => 'required|min:10|max:10',
            'cel' => 'required|min:11|max:11',
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
