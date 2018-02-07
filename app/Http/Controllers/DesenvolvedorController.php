<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
use App\User;
use App\Lista;
use App\Projeto;

class DesenvolvedorController extends Controller
{
    public function listar_projetos_dev(){
    	$id_user = \Session::get('id_user');
    	//dd($id_user);
        $projeto = DB::table('lista')->select('lista.id_lista','lista.tarefa','lista.estado_tarefa','projeto.nome','projeto.id_projeto','projeto.descricao')->join('projeto','projeto.id_projeto','=','lista.id_projeto')->where('lista.id_user','=',$id_user)->get();
    	return view('desenvolvedor.lista_projeto_dev',['projeto'=>$projeto]);
    }
}
