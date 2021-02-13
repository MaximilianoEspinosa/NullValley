<!--Componente que muestra por pantalla el botón de "Votar", que abre el modal para votar por el karateca
    correspondiente-->
<template>
    <div>
        <button class="btn btn-block" v-on:click="mostrarModalVotacion()" role='button'>
            Votar
        </button>

        <!-- Modal para votación-->
        <modal :name="modal_votacion" height="auto" resizable adaptive scrollable>
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                Indique comentarios y valoración para {{karateca.nombres}} {{karateca.apellidos}}
                            </slot>
                        </div>

                        <div class="modal-body">
                            
                            <slot name="body">
                                <!--Formulario en que el usuario ingresa los datos correspondientes para su votación-->
                                <form v-on:submit.prevent="registrarValoracion()">
                                    <label> 
                                        Recuerde que debe completar todos los campos para que su valoración sea válida y verifique que no contenga ninguna de las siguientes palabras: <p style="color:red"> Manzana, Coliflor, Bombilla, Derecha, Izquierda, Rojo, Azul </p>
                                    </label><br>

                                    <div class="form-group">
                                        <label> Nickname </label>
                                        <input type="text" v-model="nuevo_voto.nickname" class="form-control" placeholder="Ingrese nickname de 6 a 8 caracteres" minlength="6" maxlength="8" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label> Valoración </label>
                                        <select v-model="nuevo_voto.valoracion" class="form-control" required>
                                            <option :value="null" disabled> Seleccione valoración </option>
                                            <option :value="2"> Apoyar </option>
                                            <option :value="-1"> Rechazar </option>
                                        </select>
                                    </div>

                                    <div class="form-group">                                        
                                        <label> Comentario </label>
                                        <textarea type="text" v-model="nuevo_voto.comentario" class="form-control" placeholder="Ingrese comentario" rows="4" maxlength="120" style="resize: vertical;" required> </textarea>
                                    </div>

                                    <!--Se indica mensaje según el resultado del registro de votación-->
                                    <div v-if="registrado">
                                        <label style="color:green"> Voto registrado con éxito. </label>
                                    </div>

                                    <div v-if="error_registro">
                                        <label style="color:red"> Error interno, no se pudo registrar voto. </label>
                                    </div>

                                    <div v-if="nick_existente">
                                        <label style="color:red"> Ya se ha registrado un voto anteriormente con el mismo nickname. </label>
                                    </div>

                                    <div v-if="palabra_prohibida">
                                        <label style="color:red"> {{mensaje_palabra_prohibida}} </label>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5 col-md-4" v-if="registrando">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" disabled>
                                                    Registrando voto...
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-sm-5 col-md-4" v-else>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    Registrar voto
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-sm-5 col-md-4">
                                            <button class="btn btn-danger" v-on:click="eliminarModalVotacion()">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        props : ['karateca'],
                
        data() {
            return {
                
                modal_votacion: "modal-votacion-"+this.karateca.id_karateca,

                palabras_prohibidas: ["Manzana", "Coliflor", "Bombilla", "Derecha", "Izquierda", "Rojo", "Azul"],

                nuevo_voto: {
                    id_karateca: this.karateca.id_karateca,
                    comentario: "",
                    nickname: "",
                    valoracion: null
                },

                registrando: false,
                registrado: false,
                error_registro: false,

                nick_existente: false,
                palabra_prohibida: false,
                mensaje_palabra_prohibida: ""
            };
        },

        methods: {
            mostrarModalVotacion(){
                this.$modal.show(this.modal_votacion);
            },

            eliminarModalVotacion(){
                this.$modal.hide(this.modal_votacion);
            },

            registrarValoracion(){

                this.registrando = true;
                this.error_registro = false;
                this.registrado = false;
                this.nick_existente = false;
                this.palabra_prohibida = false;

                axios.post('/registrar_valoracion_karateca', this.nuevo_voto).then((response) => {
                    
                    this.registrando = false;
                    this.error_registro = false;

                    //Si se registró correctamente
                    if(response.data[0] == 1){
                        
                        this.registrado = true;
                        this.nick_existente = false;
                        this.palabra_prohibida = false;

                        window.location.reload();
                    }

                    //Si ya se ingresó comentario anteriormente con el mismo nickname
                    else if(response.data[0] == 2){
                        this.registrado = false;
                        this.nick_existente = true;
                        this.palabra_prohibida = false;
                    }

                    //Si el comentario posee una palabra prohibida
                    else if(response.data[0] == 3){
                        this.registrado = false;
                        this.nick_existente = false;
                        this.palabra_prohibida = true;
                        this.mensaje_palabra_prohibida = response.data[1];
                    }

                }).catch(e => {
                    //Si hubo error durante el registro
                    this.registrando = false;
                    this.error_registro = true;
                    this.registrado = false;
                    this.nick_existente = false;
                    this.palabra_prohibida = false;
                });
            }
        }
    };
</script>