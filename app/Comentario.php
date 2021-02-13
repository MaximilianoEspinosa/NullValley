<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //La tabla que se asocia con este modelo
    protected $table = 'comentarios';

    //Llave primaria
    protected $primaryKey = 'id_comentario';

    //Atributos del modelo
    protected $fillable = ['id_karateca', 'comentario', 'nickname', 'valoracion'];

    public $timestamps = true;
}