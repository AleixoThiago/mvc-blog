<template>
    <ol class="breadcrumb">
        <li v-for="item in lista"><a v-if="item.url" v-bind:class="defineClass" v-bind:href="item.url">{{item.nome}}</a><span v-if="!item.url">{{item.nome}}</span></li>
    </ol>
</template>

<script>
    export default {
        props:['lista'],
        mounted:function(){
            console.log(this.lista);
        },
        computed:{
            defineClass: function(){
                if (this.url){
                    return "active";
                }else{
                    return "";
                }
            }
        }
    }
</script>