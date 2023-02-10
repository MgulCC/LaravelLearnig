@extends('layouts.app')

@section('content')
<div class="container">
    editar datos del alumno
    <form action="{{ url('/alumno/' . $alumno->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('alumno._fields', ['modo' => 'Editar'])

    </form>
</div>
@endsection