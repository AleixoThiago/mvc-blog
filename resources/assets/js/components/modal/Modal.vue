<template>
    <div class="modal fade" v-bind:id="code" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{titulo}}</h4>
            </div>
            <div class="modal-body">
                <slot></slot>
            </div>
            <div class="modal-footer">
                <slot name="botoes"></slot>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['code','titulo']
    }
    
</script>