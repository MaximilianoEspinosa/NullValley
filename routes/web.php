<?php

/*Vista principal de aplicación*/
Route::get('/', function () {
	
 	//Armar rutas a fotos
 	$karatecas = \App\Karateca::all();

 	foreach ($karatecas as $karateca) {

 		//Se cargan los comentarios correspondientes al karateca
 		$karateca->comentarios;

		$url = \URL::to('/').'/cargar_foto_karateca/'.$karateca->id_karateca;
		$karateca->ruta_imagen = $url;
    }

    return view('welcome', compact('karatecas'));
});

/*Carga de foto karateca*/
Route::get('/cargar_foto_karateca/{id_karateca}', 'KaratecaController@cargarImagen');

/*Registra una nueva valoración para un karateca*/
Route::post('/registrar_valoracion_karateca', 'ComentarioController@registrarComentario');

/*Redirección a la página de resultados*/
Route::get('/resultados', 'ComentarioController@verResultados');

/*Reinicio de encuesta*/
Route::post('/reiniciar_encuesta', 'ComentarioController@reiniciarEncuesta');