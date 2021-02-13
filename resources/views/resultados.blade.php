@extends('layouts.app')
@section('content')
    <div class="container">        
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading"> 
                    Resultados
                </div>

                <div class="panel-body">

                    <!-- Se indica el resultado de la encuesta según los comentarios o votos de cada karateca -->
                    @if($resultado == "NO_QUORUM")

                        <label style="color: red;">
                            No hay cantidad de votos mínimo para decidir un ganador ({{$total_comentarios}}/10)
                        </label>

                    @elseif($resultado == "EMPATE")
                        
                        <label style="color: red;">
                            Dado que ambos candidatos no cumplen con el requisito mínimo para ganar, se declara empate.
                            El candidato con mayor puntuación debe tener una puntuación mayor a cero y no puede haber igualdad de puntajes.
                        </label>

                    @elseif($resultado == "GANADOR")
                        <h3 style="color: green;">
                            El dojo que organizará el próximo campeonato, será el Dojo de {{$ganador->nombres}} {{$ganador->apellidos}}.
                        </h3>

                        <img src="{{$ganador->ruta_imagen}}" height="300">

                        <comentarios :comentarios="{{$ganador->comentarios}}"> </comentarios>

                        <!--Si ya existe un ganador, se puede reiniciar la encuesta-->
                        <form class="form-horizontal" method="POST" action="reiniciar_encuesta">
                            {{ csrf_field() }}

                            <br><br>
                            <button type="submit" class="btn btn-success">
                                Reiniciar encuesta
                            </button>
                        </form>

                    @endif

                    <hr>

                    <!--Se indican la cantidad de votos y valoración de cada karateca -->

                    <p> Estadísticas </p>

                    <table class="table table-hover">
                        <thead>
                            <tr class="heading">
                                <th> Nombre </th>
                                <th> Valoración </th>
                                <th> Votos </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($karatecas as $karateca)
                            <tr>
                                <td> {{$karateca->nombres}} {{$karateca->apellidos}}</td>
                                <td> {{$karateca->comentarios->sum('valoracion')}} </td>
                                <td> {{count($karateca->comentarios)}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection