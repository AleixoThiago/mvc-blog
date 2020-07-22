<template>
    <span>
        <span v-if="item" >
            <button v-on:click="preencheForm()" v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + code">{{titulo}}</button>

            <button v-on:click="preencheForm()" v-if="tipo == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + code">{{titulo}}</button>

            <a v-on:click="preencheForm()" v-if="tipo == 'link'" href="#"  v-bind:class="css || ''" data-toggle="modal" v-bind:data-target="'#' + code">{{titulo}}</a>
        </span>

        <span v-if="!item">
            <button v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + code">{{titulo}}</button>

            <button v-if="tipo == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + code">{{titulo}}</button>

            <a v-if="tipo == 'link'" href="#"  v-bind:class="css || ''" data-toggle="modal" v-bind:data-target="'#' + code">{{titulo}}</a>
        </span>

    </span>
</template>

<script>
    export default {
        props:['tipo','code','titulo','css','item','url'],
        methods:{
            preencheForm: function(){
                axios.get(this.url + this.item.id).then(res => {
                    this.$store.commit('setItem',res.data);
                });
                //this.$store.commit('setItem',this.item);
            }
        }
    }
</script>