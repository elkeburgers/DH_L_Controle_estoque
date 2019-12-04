<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// abaixo incluso para usar o pacote instalado para usar apis
use Socialite;
use App\User;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // laravel pode conectar com umas 14 redes sociais diferentes
    // metodo para redirecionar para o google
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    // metodo para receber os dados do google
    public function receiveDataGoogle(){
        $userGoogle = Socialite::driver('google')->user();
        // dd($user);
        $userDb = $this->findOrCreateUser($userGoogle);

        // true para redirecionar como um usuario logado
        Auth::login($userDb, true);
        //redirectTo igual no topo, linha 30, padrao para redirecionar para a home
        return redirect($this->redirectTo);
    }

    // metodo para buscar no retorno do google o email do usuario, para saber se existe ou nao jah no nosso BD, encontrando ou criando um usuario
    public function findOrCreateUser($userGoogle){
        $user = User::where('email', $userGoogle->email)->first();

        if($user){
            return $user;
        }
        // nao precisa do else porque se der false ele jah aprte sozinho para a sequencia

        $newUser = new User();
        $newUser->name = $userGoogle->name;
        $newUser->email = $userGoogle->email;
        $newUser->img_profile = $userGoogle->avatar;
        $newUser->provider_id = $userGoogle->id;
        $newUser->active = 1;

        $newUser->save();

        return $newUser;
    }
}
