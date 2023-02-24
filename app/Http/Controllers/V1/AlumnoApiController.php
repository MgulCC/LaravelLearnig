<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno; //necesitamos el modelo alumno
use JWTAuth; //el JWTAuth
use Symfony\Component\HttpFoundation\Response; //Response
use Illuminate\Support\Facades\Validator; //validador
use Illuminate\Support\Facades\Storage;

class AlumnoApiController extends Controller
{   
    //lista los alumnos
    public function index(){
        return Alumno::get();
    }

    public function showOne($id){
        //buscar el alumno por id
        $alumno = Alumno::find($id);

        //si el alumno no existe devolvemos un error
        if(!$alumno){
            return response()->json([
                'message' => 'Alumno not found.'
            ], 404);
        }

        //si hay un alumno, lo devolvemos

        return $alumno;
    }

    public function store(Request $request){
        //validar los datos recibidos
        $data = $request->only('nombre', 'apellido', 'email', 'edad', 'direccion', 'foto');

        $validator = Validator::make($data, [
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'email' => 'required|email',
            'edad'=> 'required|int|min:6|max:100' ,
            'direccion' => 'required|string|max:250',
            'foto' => 'required|max:20480000|mimes:jpeg,jpg,png'
        ]);

        //si falla la validacion
        if($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }

        //cramos el alumno en la bd
        $alumno = Alumno::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'edad' => $request->edad,
            'direccion' => $request->direccion,
            'foto' => $request->file('foto')->store('uploads', 'public')
        ]);

        return response()->json([
            'message' => 'Alumno created',
            'data' => $alumno
        ], Response::HTTP_OK);
    }


    public function update(Request $request, $id){
        //validar datos
        $data = $request->only('nombre', 'apellido', 'email', 'edad', 'direccion', 'foto');

        $validator = Validator::make($data, [
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'email' => 'required|email',
            'edad'=> 'required|int|min:6|max:100' ,
            'direccion' => 'required|string|max:250',
            'foto' => 'max:20480000|mimes:jpeg,jpg,png'
        ]);

        //si falla
        if($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }

        //Buscamos el alumno
        $alumno = Alumno::findOrfail($id);

        //Actualizamos el alumno
        /*$alumno->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'edad' => $request->edad,
            'direccion' => $request->direccion,
            //'foto' => $request->file('foto')->store('uploads', 'public')
        ]);*/
        
        if($request->hasFile('foto')){
            //si viene una foto. eliminamos la antigua y guardamos la nueva
            Storage::delete('public/' . $alumno->foto);
            $data['foto'] = $request->file('foto')->store('uploads', 'public');  
        }

        $alumno->update($data);

        //Devolver los datos actualizados
        return response()->json([
            'message' => 'Alumno updates',
            'data' => $alumno
        ], Response::HTTP_OK);
    }
}
