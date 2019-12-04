<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
// auth eh uma classe global para fazer a sessao do usuario

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // tudo que tem de informacao do nosso usuario a auth abaixo puxa do BD
        $user = Auth::user();

        // se o usuario estiver logado - true, faz o closure abaixo
        if($user){
        return $next($request);
        }else{
            // se nao estiver logado, manda o usuario para o login
            return redirect('login');
        }
    }
}

// pode usar para varias validacoes, como por exemplo, se o usuario eh maior de idade, ou se o usuario tem um email gmail pode recuperar o endereco para encaminhar mensagens, etc.