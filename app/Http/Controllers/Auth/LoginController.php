<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginAPI(Request $request)
    {
         //$this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            if($user->active){
              $user->generateToken();

              return response()->json([
                  'success' => true,
                  'token' => $user->api_token,
                  'user' => $user
              ]);
            }else{
              return response()->json([
                  'success' => false,
                  'message' => 'Você precisa validar seu email. Acesse seu email e valide.'

              ]);
            }

        }else{
          return response()->json([
                'success' => false,
                'message' => 'Email ou senha inválido',
            ], 401);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logoutAPI(Request $request)
    {

      if(!User::checkToken($request)){
            return response()->json([
             'message' => 'Token é obrigatório',
             'success' => false,
            ],422);
        }

        $user = User::where('api_token',$request['api_token'])->first();


          if ($user) {
              $user->api_token = null;
              $user->save();
              return response()->json([
                'message' => 'Usuário deslogado com sucesso.',
                'success' => true,
              ], 200);
          }else{

              return response()->json([
                    'message' => 'Usuário não logado.',
                    'success' => false,
              ], 500);
          }

    }
}
