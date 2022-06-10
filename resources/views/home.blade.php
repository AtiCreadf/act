@extends('layout.app')

@section('titulo', 'ACT')

@section('conteudo')
    @component('layout.components.ui.cabecalho')
        @slot('titulo', 'Acordos de Cooperação Técnica')
    @endcomponent

@endsection