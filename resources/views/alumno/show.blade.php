<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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

</body>
</html>