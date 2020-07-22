@extends('layouts.app')

@section('content')

<pagina tamanho="12">
    <painel>
        <h2 align="center">{{$artigo->titulo}}</h2>
        <h4 align="center">{{$artigo->descricao}}</h4>
        <p style="text-size-adjust: 12" align="justify">
            {!!$artigo->conteudo!!}
        </p>
        <p align="right">
            <small>
                Autor: {{$artigo->users['name']}} <br>
                Data da Publicação: {{date('d-m-Y',strtotime($artigo->data))}}
            </small>
        </p>
    </painel>
</pagina>

@endsection