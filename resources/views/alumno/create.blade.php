@extends('layouts.app')

@section('content')
<div class="container">
    formulario de creacion de alumnos
    <form action="{{ url('/alumno') }}" method="post" enctype="multipart/form-data">
        @csrf
       <!-- se incluye el formulario de la vista fields, se usara para crear y editar -->
        @include('alumno._fields', ['modo' => 'Crear'])

    </form>
</div>
@endsection

