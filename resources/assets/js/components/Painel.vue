<template>
    <div v-bind:class="defineCor">
        <div v-if="titulo" class="panel-heading">{{titulo}}</div>

        <div class="panel-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props:['titulo','cor'],
        computed:{
            defineCor: function(){
                return "panel "+ (this.cor || "panel-default");        
            }
        }
    }
</script>

<style media="screen">

.blue > .panel-heading {
    color: #FFFFFF;
    background-color: #0d4a96;
}

.red > .panel-heading {
    color: #FFFFFF;
    background-color: #FF0000;
}


.green > .panel-heading {
    color: #FFFFFF;
    background-color: #00FF00;
}
</style>