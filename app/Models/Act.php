<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    use HasFactory;

    protected $table = 'ACORDO_COOP_ORGAO_ART';
    protected $primaryKey = 'ID_ACORDO_COOP_ORGAO_ART';

    protected $fillable = [
        'NR_ACORDO_COOP',
        'NR_PROCESSO',
        'NR_SITUACAO_ACORDO_COOP',
        'NR_REGISTRO_ORGAO_CREA',
        'TX_ORGAO',
        'DT_ASSINATURA',
        'DT_VIGENCIA',
        'TX_USUARIO',        
    ];

}
