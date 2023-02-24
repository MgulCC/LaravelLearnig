<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //registro de usuario
    public function register(Request $request){
        //indicamos los parametros que queremos recibir de Request
        $data = $request->only('name', 'email', 'password');

        //validacion
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
        ]);

        //devolver error si la validacion falla
        if($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }

        //Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //Nos quedamos con el usuarios y contraseña para realizar la peticion de token a JWTAuth
        //la peticion de token a JWTAuth
        $credentials = $request->only('email', 'password');

        return response()->json([
            'message' => 'User created',
            'token' => JWTAuth::attempt($credentials),
            'user' => $user
        ], Response::HTTP_OK);
    }


    //funcion que utilizaremos para hacer login
    public function authenticate(Request $request){
        //indicamos los parametros que queremos recibir de la request
        $credentials = $request->only('email', 'password');

        //validacion
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //si la validacion falla, devolvemos un error
        if($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }

        //intentamos hacer login
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                //credenciales incorrectas
                return response()->json(['error' => 'Login failed'], 401);
            }
        }catch (JWTException $e){
            //error chungo
            return response()->json([
                'message' => 'Error',
            ], 500);
        }

        //devolver el token
        return response()->json([
            'token' => $token,
            'user' => Auth::user()
        ]);
    }

    //una funcion que elimina el token y desconecta al usuario
    public function logout(Request $request){
        //valida que nos evia el token
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //fallo de validacion
        if($validator->fails()){
            return response()->json(['error' => $validator->messages()], 400);
        }

        //si el token es valido eliminamos el token desconectando al usuario
        try{
            JWTAuth::invalidate(($request->token));
            //si sale bien la peticion
            return response()->json([
                'success' => true,
                'message' => "user disconected"
            ]);
        }catch(JWTException $e){
            return response()->json([
                'success' => false,
                'message' => "Error"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    //Funcion que utilizaremos para obtener los datos del usuario y validar si el token a expirado
    public function getUser(Request $request){
        //validar que la peticion tenga el token
        $this->validate($request, [
            'token' => 'required'
        ]);
        
        //hacer la autenticacion
        $user = JWTAuth::authenticate($request->token);

        //Si no obtenemos el usuarios apartir del token, el token no es valido o ha expirado
        if(!$user){
            return response()->json([
                'message' => 'Invalid token / token expired'
            ], 401);
        }

        //devolvemos los datos del usuarios si todo va bien
        return response()->json(['user' => $user]);
    }
}
