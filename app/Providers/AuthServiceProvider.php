<?php

namespace App\Providers;
use Auth;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies($gate);

        /*Gate::define('editar_projeto/{id_projeto?}', function (User $user, Projeto $id_projeto) {
            return $user->id_user == $id_projeto->id_user;
            dd($user->id_user == $id_projeto->id_user);
        });*/
    }
}