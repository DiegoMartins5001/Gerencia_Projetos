<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $table = 'lista';
    protected $primaryKey = 'id_lista';
    protected $foreignKey = 'id_user';
    public $timestamps = FALSE;
    protected $fillable = ['id_lista','tarefa','data_limite','estado_tarefa','id_projeto','id_user'];

    static public function desenvolvedores($id_projeto){
    	return DB::table('lista')->select('projeto.nome','lista.id_projeto','users.id_user','users.name','lista.tarefa','lista.data_limite')->join('users','users.id_user','=','lista.id_user')->join('projeto','projeto.id_projeto','=','lista.id_projeto')->where('lista.id_projeto','=',$id_projeto)->get();
    }
    static public function projeto(){
    	return $this->belongsTo(Projeto::class,"id_projeto","descricao","nome");
    }
}
