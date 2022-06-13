@extends('layout.app')

@section('titulo', 'Início')

@section('conteudo')
    @component('layout.components.ui.cabecalho')
        @slot('titulo', 'Acordos de Cooperação Técnica')
    @endcomponent
    <div class="row">
        <div class="col-sm my-3">                                
            <a href="{{ route('act.create') }}" class="btn btn-success"><i class="fas fa-plus-square"></i> Novo ACT</a>
        </div>                
    </div> 
    @include('admin.includes.alerts')
    <table class="table table-condensed table-striped">
        <thead>
            <td>Nº</td>
            <td>Órgão</td>
            <td>Processo</td>
            <td>Data Assinatura</td>
            <td>Data Vigência</td>
            <td>Situação</td>
            <td>Ações</td>
        </thead>
        <tbody>
            @foreach ($acts as $act)
            <tr>
                <td>{{$act->NR_ACORDO_COOP}}</td>
                <td>{{$act->NR_REGISTRO_ORGAO_CREA}}-{{$act->TX_ORGAO}}</td>
                <td>{{$act->NR_PROCESSO}}</td>
                <td>{{dataBr($act->DT_ASSINATURA)}}</td>
                <td>{{dataBr($act->DT_VIGENCIA)}}</td>
                <td>
                    @if ($act->NR_SITUACAO_ACORDO_COOP == 1)
                        Ativo
                    @else
                        Inativo                        
                    @endif
                </td>
                <td>
                    <a href="{{ route('act.edit', $act->ID_ACORDO_COOP_ORGAO_ART, false)}}" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection