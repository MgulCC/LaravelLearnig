<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if (Session::has('mensaje'))
        <br>
        {{ Session::get('mensaje') }}
    @endif
    Listado de alumnos
    <a href="{{ url('alumno/create') }}">Registrar alumno</a>
    <hr>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>foto</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Edad</th>
                <th>Dirección</th>

                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
            <tr>
                <td>{{ $alumno->id }}</td>
                <td>
                <img src="{{ asset('storage') . '/' . $alumno->foto }}" width="50" />
                </td>
                <td>{{$alumno->nombre}}</td>
                <td>{{$alumno->apellido}}</td>
                <td>{{$alumno->email}}</td>
                <td>{{$alumno->edad}}</td>
                <td>{{$alumno->direccion}}</td>
                <td>
                    <a href="{{ url('alumno/' . $alumno->id) }}">ver</a>
                    <a href="{{ url('alumno/' . $alumno->id . '/edit') }}">editar</a>
                    <form action="{{url('alumno/' . $alumno->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="submit" onclick="return confirm('se va a elmiminar el registro #{{ $alumno->id}}')" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</body>
</html>