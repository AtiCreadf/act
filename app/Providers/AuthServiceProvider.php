<?php

namespace App\Providers;

use App\Models\Permissoes;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissoes = new Permissoes();
        $permissoes = $permissoes->getTodasPermissoes();
        
        foreach ($permissoes as $permissao) {            
            Gate::define($permissao, function(User $user) use ($permissao) {     
                return true;           
                return $user->getVerificaPermissaoUsuario($permissao);                
            });
        }

        // $permissoesUsuario = session()->permissoes ?? [];
        // foreach ($permissoes as $permissao) {            
        //     Gate::define($permissao, function(User $user) use ($permissao, $permissoesUsuario) { 
        //         return $user->getVerificaPermissaoUsuario($permissao, $permissoesUsuario);                
        //     });
        // }

        Gate::define('owner', function(User $user, $object) {
            return $user->id === $object->user_id;
        });

        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });
    }
}
