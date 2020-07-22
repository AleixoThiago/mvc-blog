@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        @if($errors->all())
        <div class="alert alert-danger alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>Não foi possível adicionar/modificar um artigo:</p>
            @foreach  ($errors->all() as $key => $value)
                <li><strong>{{$value}}</strong></li>
            @endforeach 
        </div>    
        @endif
        <painel titulo="Lista de Artigos">
        <migalhas v-bind:lista="{{$migalhas}}"></migalhas>
            <tabela-lista 
                v-bind:titulos="['#','Título','Descrição','Autor','Data de Inclusão']"
                v-bind:itens="{{json_encode($listaDeArtigos)}}"
                ordem="desc" ordemCol="0"
                criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" excluir="/admin/artigos/" token="{{ csrf_token() }}"
                modal="s"
            ></tabela-lista>
            <div align="right" >
                {{$listaDeArtigos}}
            </div>
        </painel>
    </pagina>
    <modal code="adicionar" titulo="Criando um Novo Artigo">
        <formulario id="formAdicionar" css="" action={{route('artigos.store')}} method="post" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}">
            </div>
            <div class="form-group">
                <label for="addConteudo">Conteúdo</label>
                <textarea type="text" class="form-control" id="addConteudo" name="conteudo"  placeholder="Conteúdo" v-model="$store.state.item.conteudo"></textarea>
                {{-- <ckeditor
                    id="addConteudo"
                    name="conteudo"
                    value="{{old('conteudo')}}" 
                    v-bind:config="{
                        toolbar: [[ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]], height: 300}"
                ></ckeditor> --}}

            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" value="{{old('data')}}">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formAdicionar" class="btn btn-success">Salvar</button>
        </span>
        
    </modal>
    <modal code="editar" v-bind:titulo="$store.state.item.titulo">
        <formulario id="formEditar" css="" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="titulo">Novo Título</label>
                <input type="text" class="form-control" id="titulo" v-model="$store.state.item.titulo" name="titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" v-model="$store.state.item.descricao" name="descricao" placeholder="Descrição">
            </div>
            <div class="form-group">
                <label for="editConteudo">Conteúdo</label>
                <textarea type="text" class="form-control" id="editConteudo" name="conteudo"  placeholder="Conteúdo" v-model="$store.state.item.conteudo"></textarea>
            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" value="" v-model="$store.state.item.data">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-success">Salvar Alterações</button>
        </span>
    </modal>
    <modal code="detalhe" v-bind:titulo="$store.state.item.titulo">
            <p><strong>Título: </strong>@{{$store.state.item.descricao}}</p>
            <p>@{{$store.state.item.conteudo}}</p>
    </modal>
@endsection