@extends('layout.app')

@section('titulo', 'Início')

@section('conteudo')
    @component('layout.components.ui.cabecalho')
        @slot('titulo', 'Acordos de Cooperação Técnica')
    @endcomponent

@endsection