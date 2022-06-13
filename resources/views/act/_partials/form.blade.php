
<div class="row">
    <div class="form-group col-sm-3" >
        <label for="">Número ACT</label>
        <input class="form-control" type="text" name="NR_ACORDO_COOP" id="NR_ACORDO_COOP" value="{{$act->NR_ACORDO_COOP ?? old('NR_ACORDO_COOP')}}" required >
    </div>
    <div class="form-group col-sm-4" >
        <label for="">Número Processo</label>
        <input class="form-control" type="text" name="NR_PROCESSO" id="NR_PROCESSO" value="{{$act->NR_PROCESSO ?? old('NR_PROCESSO')}}" required >
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-3" >
        <label for="">Nº Registro Órgão </label>
        <input class="form-control" type="number" name="NR_REGISTRO_ORGAO_CREA" id="NR_REGISTRO_ORGAO_CREA" value="{{$act->NR_REGISTRO_ORGAO_CREA ?? old('NR_REGISTRO_ORGAO_CREA')}}" required >
        <small>Número do registro do órgão junto ao Crea-DF</small>
    </div>
    <div class="form-group col-sm-8" >
        <label for="">Órgão </label>
        <input class="form-control" type="text" name="TX_ORGAO" id="TX_ORGAO" value="{{$act->TX_ORGAO ?? old('TX_ORGAO')}}" required >        
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-4" >
        <label for="">Assinatura</label>
        <input class="form-control" type="date" name="DT_ASSINATURA" id="DT_ASSINATURA" value="{{$act->DT_ASSINATURA ?? old('DT_ASSINATURA')}}" required >
    </div>
    <div class="form-group col-sm-4" >
        <label for="">Vigência</label>
        <input class="form-control" type="date" name="DT_VIGENCIA" id="DT_VIGENCIA" value="{{$act->DT_VIGENCIA ?? old('DT_VIGENCIA')}}" required >
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6 col-xs-12">                
        <label>Situação:</label><br>
        @if (isset($act->NR_SITUACAO_ACORDO_COOP))
            @if ($act->NR_SITUACAO_ACORDO_COOP == 1)
                <input type="checkbox" id="NR_SITUACAO_ACORDO_COOP" name="NR_SITUACAO_ACORDO_COOP" value="1" checked="checked"> 
            @else
                <input type="checkbox" id="NR_SITUACAO_ACORDO_COOP" name="NR_SITUACAO_ACORDO_COOP" value="0"> 
            @endif                            
        @else
            <input type="checkbox" id="NR_SITUACAO_ACORDO_COOP" name="NR_SITUACAO_ACORDO_COOP" value="1" checked="checked"> 
        @endif
        Ativar  
    </div>
</div>   
<div class="row">
    <div class="form-group col-sm-4 col-xs-6">     
        <div>
            Todos os campos Obrigatórios<br>
            <button type="submit" class="btn btn-success"><i class="fas fa-forward"></i> Enviar</button>
        </div>
    </div>
</div>