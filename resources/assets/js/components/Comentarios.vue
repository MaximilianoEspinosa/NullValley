<!--Componente que lista por pantalla los comentarios o votos correspondientes a un karateca-->
<template>
	<div>
		<div v-if="comentarios.length > 0">
        	<label> Comentarios ({{comentarios.length}}) </label>

        	<ul class="list-group">
        		<li v-for="comentario in comentarios" :key="comentario.id_comentario" class="list-group-item">
        			<!--p v-if="comentario.valoracion == 2" style="color:green"> {{comentario.nickname}} (+2)</p>
        			<p v-if="comentario.valoracion == -1" style="color:red"> {{comentario.nickname}} (-1) </p-->
        			<p> 
        				{{comentario.nickname}} ({{comentario.created_at | formatTimestamp}}): {{comentario.comentario}}
        			</p>
        		</li>
        	</ul>
    	</div>

        <div v-else>
            <label> No posee ningún comentario </label>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['comentarios'],
        
        data() {
            return {};
        },

        methods: {}
    };
</script>