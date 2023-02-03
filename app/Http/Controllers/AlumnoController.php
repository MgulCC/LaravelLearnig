<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alumno; //llamar al model de alumno
use Illuminate\Support\Facades\Storage;

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
        $datos['alumnos'] = Alumno::all();

        //laravel permite paginar
        //$datos['alumnos'] = Alumno::paginate(3);

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
        $datosAlumnos = $request->except('_token');
        if($request->hasFile('foto')){ //si en reuqest hay un fichero con la clave foto
            $datosAlumnos['foto'] = $request->file('foto')->store('uploads', 'public'); //guardala aqui
        }


        //hay que llamar al model alumnos arriba del script
        Alumno::insert($datosAlumnos);

        //return dd($datosAlumnos);
        return redirect('alumno')->with('mensaje', 'Se ha creado un alumno');

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
        $datosAlumno = request()->except('_token', '_method');

        if($request->hasFile('foto')){
            //si viene una foto. eliminamos la antigua y guardamos la nueva
            $alumno = Alumno::findOrFail($id);
            Storage::delete('public/' . $alumno->foto);
            $datosAlumno['foto'] = $request->file('foto')->store('uploads', 'public');
            
        }

        Alumno::where('id', '=', $id)->update($datosAlumno);
        //dd($datosAlumno);

        $alumno = Alumno::findOrFail($id);
        return view('alumno.edit', compact('alumno'));
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
            Alumno::destroy($id);
        }
        
        return redirect('alumno')->with('mensaje', 'Se ha eliminado el alumno #' . $id);

    }
}
