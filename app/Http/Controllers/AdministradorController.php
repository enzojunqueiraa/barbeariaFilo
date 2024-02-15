<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdmFormRequest;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdministradorController extends Controller
{

    public function pesquisarPorCpf(Request $request)
    {
        $administrador = Administrador::where('cpf', 'like', '%' . $request->cpf . '%')->get();

        if (count($administrador) > 0) {

            return response()->json([
                'status' => true,
                'data' => $administrador
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }
    
    public function retornarTodos()
    {
        $administrador = Administrador::all();
        return response()->json([
            'status' => true,
            'data' => $administrador
        ]);
    }

    public function pesquisarPorNome(Request $request)
    {
        $administrador =  Administrador::where('name', 'like', '%' . $request->nome . '%')->get();

        if (count($administrador) > 0) {

            return response()->json([
                'status' => true,
                'data' => $administrador
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Não há resultados para a pesquisa.'
            ]);
        }
    }

    public function excluirAdm($id)
    {
        $administrador = Administrador::find($id);

        if (!isset($administrador)) {
            return response()->json([
                'status' => false,
                'message' => "Administrador não encontrado"
            ]);
        }
        $administrador->delete();
        return response()->json([
            'status' => true,
            'message' => "Administrador excluido com sucesso"
        ]);
    }

    public function atualizarAdm(AdmFormRequest $request)
    {
        $administrador = Administrador::find($request->id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Clientes não atualizado"
            ]);
        }

        if (isset($request->name)) {
            $administrador->name = $request->name;
        }

        if (isset($request->email)) {
            $administrador->email = $request->email;
        }

        if (isset($request->cpf)) {
            $administrador->cpf = $request->cpf;
        }

        

        if (isset($request->passoword)) {
            $administrador->passoword = $request->passoword;
        }


        $administrador->update();

        return response()->json([
            'status' => true,
            'message' => "Administrador atualizado"
        ]);
    }

    public function esqueciMinhaSenha(Request $request)
    {
        $administrador = Administrador::where('email', 'LIKE', $request->email)->first();
        if ($administrador) {
            $novaSenha = $administrador->cpf;
            $administrador->update([
                'password' => Hash::make
                ($novaSenha),
                'updated_at' => now()
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Senha redefinida',
                'nova_senha' => ($novaSenha)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Administrador não encontrado'
            ]);
        }
    }

    public function store(Request $request){

        try {
            $data = $request->all();

            $data['password'] = Hash::make($request->password);
            
            $response = Administrador::create($data)->createToken($request->server("HTTP_USER_AGENT"))->plainTextToken;

            return response()->json([
                'status'=> 'success',
                'message'=> "Admin cadastrado com sucesso",
                'token' => $response
            ],200);
            
       } catch(\Throwable $th){
            
            return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],500);
        }
    
    }

    public function login(Request $request){

        try{

            if(Auth::guard('administradors')->attempt([
                'email'=> $request->email,
                'password'=> $request->password
            ])){
                $user = Auth::guard('administradors')->user();

            $token = $user->createToken($request->server('HTTP_USER_AGENT', ['administradors']))->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'Login efetuado com sucesso',
                    'token' => $token
                ]);
            } else{
                return response()->json([
                    'status' => false,
                    'message' => "Credencias incorretas"
                ]);
            }

        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }

    }

    public function verficarUsuarioLogado(){

        return Auth::user();

    }
}
