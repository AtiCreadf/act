@extends('layout.app')

@section('titulo', 'Início')

@section('conteudo')
    @component('layout.components.ui.cabecalho')
        @slot('titulo', 'Acordos de Cooperação Técnica')
    @endcomponent

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
                <td>{{$act->TX_ORGAO}}</td>
                <td>{{$act->NR_PROCESSO}}</td>
                <td>{{dataBr($act->DT_ASSINATURA)}}</td>
                <td>{{dataBr($act->DT_VIGENCIA)}}</td>
                <td>sit</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection