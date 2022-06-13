<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
        $id = $this->segment(3);
    
        return [
            'NR_ACORDO_COOP' => "required",
            'NR_PROCESSO' => "required",
            'NR_SITUACAO_ACORDO_COOP' => "required",
            'NR_REGISTRO_ORGAO_CREA' => "required",
            'TX_ORGAO' => "required|min:5|max:255",
            'DT_ASSINATURA' => "required|date_format:Y-m-d",
            'DT_VIGENCIA' => "required|date_format:Y-m-d",
            // 'TX_USUARIO' => "required",
            
        ];    
    }
/* 
    public function messages()
    {        
        return [
            
        ];    
    } */
}
