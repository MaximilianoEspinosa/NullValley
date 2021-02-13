<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent;

use App\Karateca;

class KaratecaController extends Controller
{
    /*Función que retorna una imagen correspondiente a un karateca*/

    /*Entrada: Id de karateca que se deseaa obtener imagen */
    /*Salidas: Imagen correspondiente al karateca */
	public function cargarImagen($id_karateca)
	{
		$karateca = Karateca::find($id_karateca);

        /*Si no existe karateca*/
        if($karateca == null){
            abort(404);
        }

     	$public_path = public_path();

        //$public_path = '/home2/datatacl/laravel/public'; En servidor

     	$url = $public_path.'/storage/'.$karateca->imagen;
     	
     	//Verificamos si el archivo existe y lo retornamos
     	if(\Storage::exists($karateca->imagen)){
       		return response()->download($url);
     	}
        else{
         	//Si no se encuentra lanzamos un error 404.
         	abort(404);
        }        
	}
}