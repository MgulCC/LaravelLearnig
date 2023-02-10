@extends('layouts.app')

@section('content')
<div class="container">
    datos de alumno
    <hr>
    {{ $alumno->nombre . ' ' . $alumno->apellido }}
    <br>
    Edad: {{ $alumno->direccion }}
    <br>
    Email: 
    <a href="mailto:{{ $alumno->email }}" title="enviar un mensaje">
        {{ $alumno->email}}
    </a>
    <br>
    <img src="{{ asset('storage') . '/' . $alumno->foto }}" width="50"/>
    <a href="{{ url('alumno') }}">volver</a>

</div>
@endsection