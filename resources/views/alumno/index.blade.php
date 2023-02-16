@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('mensaje'))
        <br>
        <div class="alert alert-success">
            {{ Session::get('mensaje') }}
        </div>
    @endif
    Listado de alumnos
    <a href="{{ url('alumno/create') }}" class="btn btn-info">Registrar alumno</a>
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
                    <img src="{{ asset('storage') . '/' . $alumno->foto }}" class="img-thumbnail img-fluid" width="50" />
                </td>
                <td>{{$alumno->nombre}}</td>
                <td>{{$alumno->apellido}}</td>
                <td>{{$alumno->email}}</td>
                <td>{{$alumno->edad}}</td>
                <td>{{$alumno->direccion}}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ url('alumno/' . $alumno->id) }}" class="btn btn-primary">ver</a>
                        <a href="{{ url('alumno/' . $alumno->id . '/edit') }}" class="btn btn-warning">editar</a>
                        <form action="{{url('alumno/' . $alumno->id) }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" onclick="return confirm('se va a elmiminar el registro #{{ $alumno->id}}')" class="btn btn-danger" value="Borrar">
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection