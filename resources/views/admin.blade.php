@extends('layouts.app')

@section('content')

<pagina tamanho="10">

<painel titulo="Dashboard">
    <migalhas v-bind:lista="{{$migalhas}}"></migalhas>
    Conteúdo teste...

    <div class="row">
    @can('autor')
    <div class="col-md-6">
        <caixa qtd={{$contArt}} titulo="Artigos" url="{{route('artigos.index')}}" cor="#0099FF" icone="ion ion-document-text"></caixa>
    </div>
    @endcan
    @can('eAdmin')
        <div class="col-md-6">
            <caixa qtd={{$contUser}} titulo="Usuários" url="{{route('usuarios.index')}}" cor="#ff0000" icone="ion ion-ios-people"></caixa>
        </div>
        <div class="col-md-6">
            <caixa qtd={{$contAutor}} titulo="Autores" url="{{route('autores.index')}}" cor="#33bb00" icone="ion ion-edit"></caixa>
        </div>
        <div class="col-md-6">
            <caixa qtd={{$contAdmin}} titulo="Administradores" url="{{route('adm.index')}}" cor="#888888" icone="ion ion-person"></caixa>
        </div>
    @endcan
    </div>

</painel>

</pagina>

@endsection
