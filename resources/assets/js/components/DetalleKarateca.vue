<!--Componente que muestra por pantalla el detalle de cada karateca participante en la encuesta-->
<template>
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-heading"> 
                {{karateca.nombres}} {{karateca.apellidos}} 
            </div>

            <div class="panel-body">

                <!--Se indica imagen del karateca-->
                <img :src="karateca.ruta_imagen" height="300">

                <!-- Componente VUE.JS ubicado en /resources/assets/js/components/ModalVotacion.js -->
                <modal-votacion :karateca="karateca"> </modal-votacion>

                <hr>

                <!-- Componente VUE.JS ubicado en /resources/assets/js/components/Comentarios.js -->
                <comentarios :comentarios="karateca.comentarios"> </comentarios>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props : ['karateca'],
        
        data() {
            return {};
        },

        methods: {}
    };
</script>