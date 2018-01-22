<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','data_nasc','data_admi','endereco','fone','cel','role'
    ];

    protected $primaryKey = 'id_user';

    protected $timestamp = TRUE;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function projetos(){
        return $this->hasMany(Projeto::class);
    }
}
