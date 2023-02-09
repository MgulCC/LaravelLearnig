<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    formulario de creacion de alumnos
    <form action="{{ url('/alumno') }}" method="post" enctype="multipart/form-data">
        @csrf
       <!-- se incluye el formulario de la vista fields, se usara para crear y editar -->
        @include('alumno._fields', ['modo' => 'Crear'])

    </form>
</body>
</html>

<!-- imprimir una variable -->
{{ $name }}

<!-- variable de entorno -->
env["APP_NAME"]

<!-- variable name que esta en config/app.php -->
{{ config('app.name')}}

{{ time() }}

<!-- Imprimir un valor sin escapar los caracteres espeiales con htmlspecialchars -->
{{!! $name !!}}

<!-- queremos imprimir {{ $name }} -->
@{{ $name }}

@@if => @if


@yield('content') <!-- aqui aparece el contenido de la secion "content" -->

<!-- en la vista importamos la plantilla "app" -->
@extends('app')
<!-- definir el contenido de la seccion "content" -->
@section('content')
    //aqui va el contenido
@endsection