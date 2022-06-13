@extends('layout.app')

@section('titulo', 'Início')

@section('conteudo')
    @component('layout.components.ui.cabecalho')
        @slot('titulo', 'Novo ACT')
    @endcomponent
    <form action="{{route('act.store')}}">
        @method('POST')
        @csrf
        
    </form>

@endsection