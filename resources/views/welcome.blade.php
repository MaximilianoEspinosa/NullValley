@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            @foreach($karatecas as $karateca)

                <!-- Componente VUE.JS ubicado en /resources/assets/js/components/DetalleKarateca.js -->
                <detalle-karateca
                    :key="{{$karateca->id_karateca}}"
                    :karateca="{{$karateca}}"
                >
                </detalle-karateca>
            @endforeach
        </div>
    </div>
@endsection