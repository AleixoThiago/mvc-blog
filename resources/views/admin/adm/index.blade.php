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
        <painel titulo="Lista de Administradores">
        <migalhas v-bind:lista="{{$migalhas}}"></migalhas>
            <tabela-lista 
            v-bind:titulos="['#','Nome','Email']"
            v-bind:itens="{{json_encode($listaModelo)}}"
            ordem="asc" ordemCol="-1"
            criar="#criar" detalhe="/admin/adm/" editar="/admin/adm/"
            modal="s"
            ></tabela-lista>
            <div align="right" >
                {{$listaModelo}}
            </div>
        </painel>
    </pagina>
    <modal code="adicionar" titulo="Adicionar um Usuário">
        <formulario id="formAdicionar" css="" action={{route('adm.store')}} method="post" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="admin">Administrador</label>
                <select class="form-control" name="admin" id="admin">
                    <option {{(old('admin') && old('admin') == 'N' ? 'selected' : '')}} value="N">Não</option>
                    <option {{(old('admin') && old('admin') == 'S' ? 'selected' : '' )}} {{(!old('admin') ? 'selected' : '')}} value="S">Sim</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formAdicionar" class="btn btn-success">Salvar</button>
        </span>
        
    </modal>
    <modal code="editar" v-bind:titulo="'Edição de Administrador'">
        <formulario id="formEditar" css="" v-bind:action="'/admin/adm/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" v-model="$store.state.item.name" name="name" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" id="email" v-model="$store.state.item.email" name="email" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="admin">Administrador</label>
                <select class="form-control" name="admin" id="admin" v-model="$store.state.item.admin">
                    <option value="N">Não</option>
                    <option value="S">Sim</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-success">Salvar Alterações</button>
        </span>
    </modal>
    <modal code="detalhe" v-bind:titulo="'Usuário: ' + $store.state.item.name">
            <p><strong>E-mail: </strong>@{{$store.state.item.email}}</p>
    </modal>
@endsection