<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karateca extends Model
{
    //La tabla que se asocia con este modelo
    protected $table = 'karatecas';

    //Llave primaria
    protected $primaryKey = 'id_karateca';

    //Atributos del modelo
    protected $fillable = ['nombres', 'apellidos', 'imagen', 'ruta_imagen'];

    //No se guardan la hora y fecha y creación y actualización (created_at y updated_at)
    public $timestamps = false;

    //Relación uno a muchos con comentarios, se usa id de karateca como llave foranea para obtener los comentarios.
    public function comentarios(){

    	return $this->hasMany('App\Comentario', 'id_karateca', 'id_karateca');
    }
}