<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Tymon\JWTAuth\Contracts\JWTSubject;


// class User extends Authenticatable
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $connection = 'corporativo';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'fone_contato', 'tipo_usuario', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function salvarUsuario($usuario){

        $usu = DB::select('select * from users where email = ?', [$usuario['email']]);
        if (!$usu) {
            return DB::table('users')->insertGetId($usuario);
        } else {
            return $usu[0]->id;
        }
    }

    public function gerarSenhaAleatoria($cpf){
        $listAlpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789;:!?.$/*-+&@_+;./*&?$-!';
        $pass = substr(str_shuffle($listAlpha), 8, 10);
        Log::info($cpf.": ".$pass);
        return $pass;
    }

    public function getUsuario($idUsuario){
        $user = User::Select('*')
            ->where('id', $idUsuario)
            ->first();

        return $user;
    }

    public function getUserNameAd(){        
        return strstr(Auth::user()->email, '@', true);
    }

    public function getUserNameId(){        
        return Auth::user()->id;
    }
    
    public function getPermissoesUsuario(){
        $permissoes = new Permissoes;
        //identificando se é o profissional que está logado
        //Controle de perfis para empresa, profissional, conselheiro e colaborador
        if($this->username == 'empresa_usuario')
            $usuario_ad = 'empresa';
        elseif ($this->name == 'Conselheiro')
            $usuario_ad = 'oriehlensocconselheiro';
        elseif ($this->getUserNameProfissional() != null)
            $usuario_ad = 'profissional';
        else
            $usuario_ad = strstr(Auth::user()->email, '@', true); //login de funcionario do Crea
       
        $permissoes = $permissoes->getPermissoesUsuario($usuario_ad); 

        return $permissoes;
    }

    public function getVerificaPermissaoUsuario(String $permissao)
    {  
        return in_array($permissao, (session()->get('permissoes') ?? []));
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }

}
