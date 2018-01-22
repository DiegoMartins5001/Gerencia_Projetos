<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Validator;
use App\Projeto;
use App\Lista;
use DB;
use Carbon\Carbon;
use Auth;

class ProjetoController extends Controller{
    public function novo_projeto(){
    	$users = User::orderBy('name')->where('role','dev')->get();
    	return view('projeto.form_cadastrar',['users'=>$users]);
    }

    public function listar_projetos(){
    	$id_user = \Session::get('id_user');
        $projeto = Projeto::orderBy('nome')->where('id_user',auth()->user()->id_user)->paginate(5);
        //dd($projeto);
    	return view('projeto.listar',['projeto'=>$projeto]);
    }

    public function detalhes_projeto(Request $request, $id_projeto){
        $lista = DB::table('lista')->select('projeto.nome','lista.id_projeto','users.id_user','users.name','lista.tarefa','lista.data_limite','projeto.descricao','lista.estado_tarefa','lista.id_lista')->join('users','users.id_user','=','lista.id_user')->join('projeto','projeto.id_projeto','=','lista.id_projeto')->where('lista.id_projeto','=',$id_projeto)->orderBy('estado_tarefa','true')->paginate(5);
        $nome = Projeto::find($id_projeto);
    	return view('projeto.detalhes',['lista'=>$lista,'id_projeto'=>$id_projeto,'nome'=>$nome]);
    }

    public function cadastrar_projeto(Request $request){
    	$this->validate($request,[
            'nome' => 'required|unique:projeto',
            'descricao' => 'required',
            'id_user' => 'required',
            'tarefa' => 'required',
            'data_limite' => 'required|date',
        ],[
            'nome.required'       => 'Campo Nome Obrigatório',
            'nome.unique:projeto' => 'Esse Nome já está em uso',
            'descricao.required'  => 'Campo Descrição Obrigatório',
        ]);

        $data_hoje = \Carbon\Carbon::today()->format('Y/m/d');
        if($data_hoje > str_replace('-', '/', $request->data_limite)){
            return redirect()->back()->withInput()->with('mensagens-danger','Data não pode Ser Retrotiva!!!');
        }else{
            $projeto = new Projeto();
            $projeto->nome = $request->input('nome');
            $projeto->descricao = $request->input('descricao');
            $projeto->id_user = \Session::get('id_user');
            $projeto->save();
            $lista = new Lista();
            $lista->tarefa = $request->input('tarefa');
            $lista->data_limite = $request->input('data_limite');
            $lista->id_projeto = $projeto->id_projeto;
            $lista->id_user = $request->input('id_user');
            $lista->save();
            return redirect('listar_projetos')
            ->with('mensagens-sucesso','Projeto Cadastrado com Sucesso!!!');
        }
    }

    public function form_cadastrar_devs($id_projeto){
        $id_not = DB::table('lista')->select('projeto.nome','lista.id_projeto','users.id_user','users.name','lista.tarefa','lista.data_limite')->join('users','users.id_user','=','lista.id_user')->join('projeto','projeto.id_projeto','=','lista.id_projeto')->where('lista.id_projeto','=',$id_projeto)->get();
        //dd($id_not);
    	$users = User::orderBy('name')->where('role','dev')->join('lista','lista.id_projeto','lista.id_user')->get();
        //dd($users);
        $users_participantes = Lista::desenvolvedores($id_projeto);
        
        return view('projeto.form_cadastrar_dev',['users'=>$users,'users_participantes'=>$users_participantes,'id_projeto'=>$id_projeto]);
    }

    public function cadastrar_devs_projeto(Request $request,$id){
    	$this->validate($request,[
            'id_user' => 'required',
            'tarefa' => 'required',
            'data_limite' => 'required|date',
        ]);
    	$projeto = Projeto::find($id);
    	$lista = new Lista();
        $lista->tarefa = $request->input('tarefa');
        $lista->data_limite = $request->input('data_limite');
        $lista->id_projeto = $projeto->id_projeto;
        $lista->id_user = $request->input('id_user');
        $lista->save();
        return redirect('cadastrar_devs/'.$projeto->id_projeto)->with('mensagens-sucesso','Desenvolvedor cadastrado com sucesso');
    }
    public function muda_status(Request $request,$id_lista){
        //dd($id_lista);
        $status = Lista::where('id_lista','=',$id_lista)->first();       
        if ($status == null) {
            return back()->with('mensagens-danger','Projeto nao Encontrado!');
        }
        $consulta = DB::table('lista')->select('projeto.id_user','lista.id_lista')->join('users','users.id_user','=','lista.id_user')->join('projeto','projeto.id_projeto','=','lista.id_projeto')->where('lista.id_lista','=',$id_lista)->where('projeto.id_user','=',Auth::user()->id_user)->count();
        if($consulta == 1){
            $status->estado_tarefa = TRUE;
            $status->save();
            return redirect('detalhes_projeto/'.$status->id_projeto)->with('mensagens-sucesso', 'Tarefa Concluida');   
        }else{
            return redirect('detalhes_projeto/'.$status->id_projeto)->with('mensagens-danger', 'Erro ao tentar atualizar o status.');
        } 
    }

    public function editar_projeto(Request $request, $id_projeto){
        
        $projeto = Projeto::find($id_projeto);
        //dd($projeto);
        if(\Session::get('id_user') == null ){
            return redirect('listar_projetos')->with('mensagens-danger','Erro, Projeto nao Encontrado');
        }else{
            //dd($projeto);
            return view('projeto.editar_projeto',['projeto'=>$projeto]);
        }
    }
    public function salvar_projeto(Request $request,$id_projeto){
        $projeto = null;
        $projeto = Projeto::find($request->id_projeto);
        $projeto->nome = $request->nome;
        $projeto->descricao = $request->descricao;
        $projeto->update();
        return redirect('listar_projetos')->with('mensagens-sucesso','Atualizado com Sucesso');
    }
    public function deletar_projeto($id_projeto){
        $projeto = Projeto::find($id_projeto);
        return view('projeto.excluir_projeto',['projeto'=>$projeto]);
    }
    public function excluir_projeto($id_projeto){
        $projeto = Projeto::find($id_projeto);
        $lista = Lista::where('id_projeto','=',$id_projeto);
        $lista->delete();
        $projeto->delete();
        return redirect('listar_projetos')->with('mensagens-sucesso','Excluido com Sucesso');
    }
    public function add_novos_dev($id_projeto){
        $users = User::orderBy('name')->where('role','dev')->get();
        return view('projeto.form_cadastrar_dev',['users'=>$users,'id_projeto'=>$id_projeto]);
    }
    public function salvar_dev(Request $request,$id_projeto){
        $data_hoje = \Carbon\Carbon::today()->format('Y/m/d');
        if($data_hoje > str_replace('-', '/', $request->data_limite)){
            return redirect()->back()->withInput()->with('mensagens-danger','Data não pode Ser Retrotiva!!!');
        }else{
            $dev = new Lista();
            $dev->tarefa = $request->input('tarefa');
            $dev->data_limite = $request->input('data_limite');
            $dev->estado_tarefa = $request->estado_tarefa = false;
            $dev->id_projeto = $id_projeto;
            $dev->id_user = $request->input('id_user');
            $dev->save();
            return redirect('detalhes_projeto/'.$id_projeto)->with('mensagens-sucesso','Novo Desenvolvedor cadastrado para o Projeto / Nova Tarefa Vinculada ao Desenvolvedor');
        }
    }
}
