@extends('layouts.app')

@section('content')

<pagina tamanho="12">
    <painel titulo="Artigos">

        <p>
            <form class="form-inline text-right" action="{{route('site')}}" method="get">
                <input type="search" class="form-control" name="busca" placeholder="Buscar" value="{{isset($busca) ? $busca : ""}}">
                <button class="btn btn-info">Buscar</button>
            </form>
                
        </p>

        <div class="row">
            @foreach ($lista as $key => $value)
                <artigo-card 
                titulo="{{$value->titulo}}" 
                autor="{{$value->autor}}" 
                data="{{$value->data}}" 
                descricao="{{str_limit($value->descricao,40,"...")}}" 
                link="{{route('artigo',[$value->id,str_slug($value->titulo)])}}" 
                sm="6" 
                md="4" 
                imagem="https://www.grupoescolar.com/a/b/artigo-1F.jpg"
                ></artigo-card>
            @endforeach
        </div>
        <div align="right" >
            {{$lista}}
        </div>
    </painel>
</pagina>

@endsection