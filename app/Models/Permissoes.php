<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Permissoes extends Model
{
    use HasFactory;
    protected $table = 'tb_usuarios_perfis';
    //protected $primaryKey = 'FK_ID_USUARIO';

    public function getPerfilUsuario($usuario_ad)
    {

        $perfis_usuario = DB::connection('permissoes')
            ->select('select perfil 
                from tb_usuarios_perfis 
                inner join tb_perfis on tb_perfis.id_perfil = tb_usuarios_perfis.fk_id_perfil                
                where 
                tb_perfis.situacao = 1                
                and fk_id_sistema = 5
                and tb_usuarios_perfis.usuario_ad = ? ', [$usuario_ad]);

        $perfis = [];


        foreach ($perfis_usuario as $perfil){  
            array_push($perfis, $perfil->perfil);            
        }

        return $perfis;  

    }

    public function getTodasPermissoes(){

        $todas_permissoes = Cache::remember('todas_permissoes', 60, function () {
            return DB::connection('permissoes')
                ->select('select tx_no_action 
                    from tb_usuarios_perfis 
                    inner join tb_perfis on tb_perfis.id_perfil = tb_usuarios_perfis.fk_id_perfil
                    inner join tb_perfis_actions on tb_perfis_actions.fk_id_perfil = tb_perfis.id_perfil
                    inner join tb_actions on tb_actions.pk_id_action = tb_perfis_actions.fk_id_action
                    where 
                    tb_perfis.situacao = 1
                    and tb_actions.in_st_action = 1
                    and fk_id_sistema = 5
                    ');
        });
        

        $permissoes = [];
        
        foreach ($todas_permissoes as $index => $permissao){  
            //dd($permissao)      ;
            array_push($permissoes, $permissao->tx_no_action);            
        }

        return $permissoes;  
    }

//     /**
//      * Lista permissões de um usuário
//      * @param string usuario_ad
//      * @return array permissoes
//      */
    public function getPermissoesUsuario($usuario_ad)
    {

        $permissoes_usuario = DB::connection('permissoes')
            ->select("select tx_no_action 
                from tb_usuarios_perfis 
                inner join tb_perfis on tb_perfis.id_perfil = tb_usuarios_perfis.fk_id_perfil
                inner join tb_perfis_actions on tb_perfis_actions.fk_id_perfil = tb_perfis.id_perfil
                inner join tb_actions on tb_actions.pk_id_action = tb_perfis_actions.fk_id_action
                left join tb_afastamentos on tb_afastamentos.usuario_ad = tb_usuarios_perfis.usuario_ad
                where 
                tb_perfis.situacao = 1
                and tb_actions.in_st_action = 1
                and fk_id_sistema = 5
                and (SELECT count(*)
                        FROM `tb_afastamentos`
                        where DATE_FORMAT(now(),'%Y-%m-%d') BETWEEN tb_afastamentos.dt_inicio and tb_afastamentos.dt_fim
                    )
                    <= 0
                and tb_usuarios_perfis.usuario_ad = ? ", [$usuario_ad]);
                
        //dd($permissoes_usuario);
        $permissoes = [];
        foreach($permissoes_usuario as $permissao){
            array_push($permissoes, $permissao->tx_no_action);
        }
        //dd($permissoes);
        return $permissoes;            
    }

} 
