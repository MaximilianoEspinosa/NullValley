<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Karateca;
use App\Comentario;
use DB;

class ComentarioController extends Controller
{
    /*Función que registra un nuevo comentario o voto, verificando que un nickname no haga más de un comentario y también se verifica que no se registren comentarios con palabras ofensivas de un listado dado en el enunciado.*/

    /*Entrada: request con los datos ingresados por el usuario en modal de votación*/
    /*Salidas: 1 - El voto es ingresado exitosamente.
               2 - Ya se ha registrado un voto anteriormente con el mismo nickname.
               3 - El comentario ingresado posee al menos una palabra prohibida y se indica que palabras corresponden.
    */
	public function registrarComentario(Request $request)
	{
        //Se verifica que no exista un comentario con el nickname ingresado
        $comentario_aux = Comentario::where('nickname', $request->nickname)->get();
        if(count($comentario_aux) > 0){
            return [2];
        }

        //Se verifica que no exista un comentario con una palabra prohibida.
        //FUENTE: https://stackoverflow.com/questions/47255135/laravel-5-5-check-if-string-contains-exact-words
        $palabras_prohibidas = array("Manzana", "Coliflor", "Bombilla", "Derecha", "Izquierda", "Rojo", "Azul");
        $matches = array();

        $match_encontrado = preg_match_all("/\b(" . implode($palabras_prohibidas,"|") . ")\b/i", 
            $request->comentario, $matches);

        //Si se encontraron palabras prohibidas.
        if($match_encontrado){
            $palabras = array_unique($matches[0]);

            //Se concatena palabras con mensaje para indicar al usuario.
            $mensaje = "Su comentario posee al menos una de las palabras prohibidas mencionadas anteriormente:";

            foreach ($palabras as $palabra) {
                $mensaje = $mensaje." ".$palabra;
            }

            $mensaje = $mensaje.".";
            return [3, $mensaje];
        }

        //Si no existe un comentario con el nickname ingresado y sin palabras prohibidas, se registra el comentario con su evaluación correspondiente.
		Comentario::create([
            'id_karateca' => $request['id_karateca'],
            'comentario' => $request['comentario'],
            'nickname' => $request['nickname'],
            'valoracion' => $request['valoracion']
        ]);

     	return [1];
	}

    /*Función que determina al ganador de la encuesta*/
    
    /*Entrada: No posee */
    /*Salidas: Redirige a vista de resultados con los votos y valoraciones de la encuesta */
    public function verResultados(){

        $ganador;
        $karatecas = Karateca::all();
        $comentarios = Comentario::all();

        $total_comentarios = count($comentarios);
        $quorum = 10;

        //Se comparan, el ganador es el que tenga mayor valoración y si existe al menos el quorum necesario (10)
        if($total_comentarios >= $quorum){
            
            $valoracion_k_1 = $karatecas[0]->comentarios->sum('valoracion');
            $valoracion_k_2 = $karatecas[1]->comentarios->sum('valoracion');            

            if(($valoracion_k_1 > $valoracion_k_2) && ($valoracion_k_1 > 0)){
                $resultado = "GANADOR";
                $ganador = $karatecas[0];

                //Se prepara imagen;
                $url = \URL::to('/').'/cargar_foto_karateca/'.$ganador->id_karateca;
                $ganador->ruta_imagen = $url;

            }

            else if(($valoracion_k_1 < $valoracion_k_2) && ($valoracion_k_2 > 0)){
                $resultado = "GANADOR";
                $ganador = $karatecas[1];

                //Se prepara imagen;
                $url = \URL::to('/').'/cargar_foto_karateca/'.$ganador->id_karateca;
                $ganador->ruta_imagen = $url;
            }

            else {
                $resultado = "EMPATE";
            }
        }
        else{
            $resultado = "NO_QUORUM";
        }

        return view('resultados', compact('resultado', 'ganador', 'karatecas', 'total_comentarios'));
    }

    /*Función que reinicia la encuesta eliminando todos los comentarios registrados*/

    /*Entrada: No posee */
    /*Salidas: Redirige a la vista principal de la aplicación */
    public function reiniciarEncuesta(){

        DB::table('comentarios')->delete();

        return redirect('/');
    }
}