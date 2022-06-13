@extends('layout.app')

@section('titulo', 'Início')

@section('conteudo')
    @component('layout.components.ui.cabecalho')
        @slot('titulo', 'Editar ACT')
    @endcomponent
    <form action="{{route('act.update', $act->ID_ACORDO_COOP_ORGAO_ART)}}" class="form" method="POST">        
        @csrf        
        @method('PUT')
        @include('act._partials.form')
    </form>

@endsection