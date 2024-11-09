<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilizador;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        /*
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'telefone' => 'required|unique:users',
            'password' => 'required|min:6',
        ], [
            'nome' => 'Nome e um campo obrigatorio.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        */
        //$estado = Utilizadors::where('telefone',$request->telefone)->first()->estado;
        $user = Utilizador::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'password' => bcrypt($request->password),
            'foto' => "padrao.png",
            'bio' => "Sou uma pessoa muito simples, que gosta de fazer novas amizades",
            'estado' => 1,
            'provincia_id' => 1,
            'municipio_id' => 1,
            'ano' => 2002,
            'genero_id' => 1,
        ]);

        //$token = $user->createToken('UserAuth')->accessToken;

        return response()->json($user, 200);
    }

    public function updateInicial(Request $request)
    {
        /*
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'telefone' => 'required|unique:users',
            'password' => 'required|min:6',
        ], [
            'nome' => 'Nome e um campo obrigatorio.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        */
        //$estado = Utilizadors::where('telefone',$request->telefone)->first()->estado;
        $user = Utilizador::where('id', $request->id)->first();
        $user->bio = $request->bio;
        $user->ano = $request->ano;
        $user->genero_id = $request->genero_id;
        $user->save();

        //$token = $user->createToken('UserAuth')->accessToken;

        return response()->json($user, 200);
    }

    public function show($id)
    {
        $user = Utilizador::where('id', $id)->first();
        return response()->json($user, 200);
    }

}
