<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model{
    protected $table = 'projeto';
    public $timestamps = FALSE;
    protected $fillable = ['id_projeto','nome','descricao'];
    protected $foreignKey = 'id_user';
    protected $primaryKey = 'id_projeto';

    static public function projeto(){
    	return $this->belongsTo(Lista::class,"id_projeto","descricao","nome");
    }
    static public function devs(){
    	return $this->hasMany(User::class);
    }

}
