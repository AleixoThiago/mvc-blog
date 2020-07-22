<template>
    <div>
        <div class="form-inline">
            <a v-if="criar && !modal" type="button" v-bind:class="css || 'btn btn-primary'" v-bind:href="criar">Criar</a>
            <modal-link v-if="criar && modal" code="adicionar" tipo='button' titulo="Criar" css=""></modal-link>
            <div  class="form-group pull-right">
                <input type="search" class="form-control" placeholder="Buscar" v-model="buscar">
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="cursor:pointer" v-on:click="ordenaColuna(index)" v-for="(titulo,index) in titulos">{{titulo}}</th>

                    <th v-if="detalhe || editar || excluir">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in lista">
                    <td v-for="i in item">{{i | formataData}}</td>
                    <td v-if="detalhe || editar || excluir">
                        <form v-bind:id="index" v-if="excluir && token" v-bind:action="excluir + item.id" method="post">

                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" v-bind:value="token">

                            <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                            <modal-link v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" code="detalhe" tipo='button' titulo="Detalhe" css="btn btn-detail"></modal-link>

                            <a v-if="editar && !modal" v-bind:href="editar"> Editar |</a>
                            <modal-link v-if="editar && modal" v-bind:item="item" v-bind:url="editar" code="editar" tipo='button' titulo="Editar" css="btn btn-edit"></modal-link>

                            <a type="button" class="btn btn-del" href="#" v-on:click="executaForm(index)">Excluir</a>

                        </form>
                        <span v-if="!token">
                            <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                            <modal-link v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" code="detalhe" tipo='button' titulo="Detalhe" css="btn btn-detail"></modal-link>

                            <a v-if="editar && !modal" v-bind:href="editar"> Editar |</a>
                            <modal-link v-if="editar && modal" v-bind:item="item" v-bind:url="editar" code="editar" tipo='button' titulo="Editar" css="btn btn-edit"></modal-link>
                        </span>
                        <span v-if="token && !excluir">
                            <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                            <modal-link v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" code="detalhe" tipo='button' titulo="Detalhe" css="btn btn-detail"></modal-link>

                            <a v-if="editar && !modal" v-bind:href="editar"> Editar |</a>
                            <modal-link v-if="editar && modal" v-bind:item="item" v-bind:url="editar" code="editar" tipo='button' titulo="Editar" css="btn btn-edit"></modal-link>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:['titulos','itens','ordem','ordemCol','criar','detalhe','editar','excluir','token','modal'],

        data: function(){
            return {
                buscar:'',
                ordemAux: this.ordem || "asc",
                ordemAuxCol: this.ordemCol || 0
            }
        },

        computed:{
            lista:function(){
                let lista = this.itens.data;
                let ordem = this.ordemAux || "asc";
                let ordemCol = this.ordemAuxCol ||  0;
                ordem = ordem.toLowerCase();
                ordemCol = parseInt(ordemCol);

                if (ordem == "asc"){
                    lista.sort(function(a,b){
                    if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]){return 1;}
                    if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]){return -1;}
                    return 0;
                    });
                } else {
                    lista.sort(function(a,b){
                    if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]){return 1;}
                    if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]){return -1;}
                    return 0;
                    });
                }

                if (this.buscar){
                    return lista    .filter(res => {
                        res = Object.values(res);
                        for(let k = 0;k < res.length; k++){
                        if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0){
                            return true;
                        }
                    }
                    return false;
                });
                }
                return lista    ;
            }
        },

        methods:{
            executaForm: function(index){
                document.getElementById(index).submit();
            },
            ordenaColuna: function(coluna){
                this.ordemAuxCol = coluna;
                if (this.ordemAux.toLowerCase() == "asc"){
                    this.ordemAux = 'desc';
                }else{
                    this.ordemAux = 'asc';
                }
            }
        },
        
        filters: {
            formataData: function(valor){
                if (!valor) return '';
                valor = valor.toString();
                if(valor.split('-').length == 3){
                   valor = valor.split('-');
                   return valor[2] + '/' + valor[1] + '/' + valor[0];
                }
                return valor;
            }
        }
    }
</script>

<style>

.btn-detail {
    color: #000000;
    background-color: #9fbdff;
    border-color: #9fbdff;
    border-radius: 20px;
}

.btn-edit {
    color: #000000;
    background-color: #99f38d;
    border-color: #99f38d;
    border-radius: 20px;
}

.btn-del {
    color: #000000;
    background-color: #fc4d4d;
    border-color: #fc4d4d;
    border-radius: 20px;
}

</style>