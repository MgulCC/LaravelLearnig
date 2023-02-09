<label for="nombre">Nombre</label>
<input type="text" name="nombre" id="nombre" value="{{ $alumno->nombre ?? '' }}">
<br/>
<label for="apellido">Apellido</label>
<input type="text" name="apellido" id="apellido" value="{{ $alumno->apellido ?? '' }}">
<br/>
<label for="email">Email</label>
<input type="email" name="email" id="email" value="{{ $alumno->email ?? '' }}">
<br/>
<label for="edad">Edad</label>
<input type="number" name="edad" id="edad" value="{{ $alumno->edad ?? '' }}">
<br/>
<label for="direccion">Direccion</label>
<input type="text" name="direccion" id="direccion" value="{{ $alumno->direccion ?? '' }}">
<br/>
@if(isset($alumno->foto))
<img src="{{ asset('storage') . '/' . $alumno->foto }}" width="50"/>
<br/>
@endif
<label for="foto">Foto</label>
<input type="file" name="foto" id="foto">
<br/>

<input type="submit" value="{{ $modo }} alumno">
<a href="{{ url('alumno') }}">volver</a>