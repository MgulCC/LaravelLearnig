<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alumno; //llamar al model de alumno
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //enviamos todos los datos para que los muestre
        //$datos['alumnos'] = Alumno::all(); //-activa esto para que nos devuelva todo

        //laravel permite paginar
        $datos['alumnos'] = Alumno::paginate(3);
        // $edad = 18;
        // $datos['alumnos'] = DB::select('select * from alumnos where edad > ? AND apellido = ?', [$edad, 'Bolson']);
        //DB::select('select * from alumnos where edad > :edad AND apellido = :ap', ['edad' => $edad, 'ap' => "Bolson"]);
        return view('alumno.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumno.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //validacion
        $campos = [
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'email' => 'required|email',
            'edad'=> 'required|int|min:6|max:100' ,
            'direccion' => 'required|string|max:250',
            'foto' => 'required|max:20480000|mimes:jpg,png'
        ];

        //los mensajes de error
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'foto.required' => 'la foto es obligatoria',
            'edad.required' => 'la edad es obligatoria',
            'direccion.required' => 'la direccion es obligatoria',
            'max' => 'El campo :atribute no puede ternetr mas de :max caracteres',
            'foto.max' => 'La foto no puede ser mator de :max bytes',
            'email.email' => 'el email no tiene el formato correcto',
            'foto.mimes' => 'La foto debe estar en uno de los siguientres formatos :values'

        ];

        $this->validate($request, $campos, $mensaje);


        $datosAlumnos = $request->except('_token');
        if($request->hasFile('foto')){ //si en request hay un fichero con la clave foto
            $datosAlumnos['foto'] = $request->file('foto')->store('uploads', 'public'); //guardala aqui
        }


        //hay que llamar al model alumnos arriba del script
        //Alumno::insert($datosAlumnos);

        // DB::insert('insert into alumnos (nombre, apellido, edad, email, direccion, foto) values (?, ?, ?, ?, ?, ?)', 
        // [$datosAlumno['nombre'],
        // $datosAlumno['apellido'],
        // $datosAlumno['edad'],
        // $datosAlumno['email'],
        // 'san joaquin',
        // $datosAlumno['foto']]);

        //return dd($datosAlumnos);
        return redirect('alumno')->with('mensaje', 'Se ha creado un alumno');
        //return redirect('alumno')->with('mensaje', 'Se ha creado un alumno a' . $datosAlumno['nombre']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);

        return view('alumno.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumno.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validacion
        $campos = [
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'email' => 'required|email',
            'edad'=> 'required|int|min:6|max:100' ,
            'direccion' => 'required|string|max:250',
            'foto' => 'max:20480000|mimes:jpg,png'
        ];

        //los mensajes de error
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'edad.required' => 'la edad es obligatoria',
            'direccion.required' => 'la direccion es obligatoria',
            'max' => 'El campo :atribute no puede ternetr mas de :max caracteres',
            'foto.max' => 'La foto no puede ser mator de :max bytes',
            'email.email' => 'el email no tiene el formato correcto',
            'foto.mimes' => 'La foto debe estar en uno de los siguientres formatos :values'

        ];

        $this->validate($request, $campos, $mensaje);

        $datosAlumno = request()->except('_token', '_method');

        if($request->hasFile('foto')){
            //si viene una foto. eliminamos la antigua y guardamos la nueva
            $alumno = Alumno::findOrFail($id);
            Storage::delete('public/' . $alumno->foto);
            $datosAlumno['foto'] = $request->file('foto')->store('uploads', 'public');
            
        }

        //Alumno::where('id', '=', $id)->update($datosAlumno); //-> activa esto
        //dd($datosAlumno); //-> y esto

        // $affected = DB::update('update alumnos set direccion = "San Joaquin" where id < ?', [10]);
        // echo "se ha modificado $affected alumnos";
        // dd($affected);

        $alumno = Alumno::findOrFail($id);

        //return view('alumno.edit', compact('alumno'));

        return redirect('alumno')->with('mensaje', 'se ha registrado a ' . $datosAlumno['nombre']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);

        if(Storage::delete('public/' . $alumno->foto)){
            Alumno::destroy($id); //->activa esto

            // $deleted = DB::delete('delete from alumnos where id = ?', [$id]);
            // echo "se ha modificado $deleted alumnos";
            // dd($deleted);

        }
        
        return redirect('alumno')->with('mensaje', 'Se ha eliminado el alumno #' . $id);

    }
}

//consultas generales que no devuelven nada
//DB::statement('drop table alumno');

//Consultas no preparadas
//DB::unprepared('update alumnos set edad = 120 where > 10');

//Trasacciones
// DB::transaction(function(){
//     DB::update('update alumnos set edad = 33');
//     DB::delete('delete from post');
// }, 5); //lo va a intentaar 5 veces

//otra forma de ejecutar transaciones
// DB::beginTransaction();

// DB::rollBack();

// DB::commit();
