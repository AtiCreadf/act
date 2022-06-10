<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private $key = 'EavXrPCq8UyxIIZEyOxW100zR7wiilagvz0BXDjWwCuVCbGbrfQzhCy189o1Mcp8';

    //Login do sistema corporativo
    public function authenticate(Request $request)
    {
        //dd("auth");
        try {            
            $decoded = JWT::decode($request->token, new Key($this->key, 'HS256'));
            $user = User::find($decoded->user->id);
        } catch (\UnexpectedValueException $uve) {
            $uve->getMessage();
        }
        
        if(isset($user->id)){
            if($decoded->user->tipo_usuario == 1){
                if (Auth::loginUsingId($user->id)) {

                    if(isset($decoded->dadosCA)){
                        $dadosCA = Http::post(env('URL_CORP') . '/api/ca/usuario', [
                            'cpf' => Auth::user()->cpf,
                            'id_usuario' => Auth::user()->id,
                            'name' => Auth::user()->name,
                            'password' => Auth::user()->password,
                        ])->json();

                        session(['dadosCA' => $dadosCA]);
                    }

                    return redirect()->route('home');
                }
            }
        }
    }
    
    public function login()
    {
        return view('auth.login');
    }
   
    public function logout(Request $request)
    {
        try {            
            //Destroi a sessão do usuario
            Auth::logout();
    
            $request->session()->invalidate();        
            $request->session()->regenerateToken();
            
            $rota = $request->rota ?? '/login?SIS=ACT';
    
            return redirect(env('URL_CORP') . $rota);
            
        } catch (\Throwable $th) {
            Auth::logout();
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authJwt(Request $request)
    {
        $credentials = request(['username', 'password']);

        $token = auth()->guard('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->guard('api')->user());
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ]);
    }
}
