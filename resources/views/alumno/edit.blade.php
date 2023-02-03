<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    editar datos del alumno
    <form action="{{ url('/alumno/' . $alumno->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('alumno._fields')

    </form>
</body>
</html>