<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
        ];
    }
}
