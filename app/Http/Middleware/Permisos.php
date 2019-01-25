<?php
namespace App\Http\Middleware;
use App\Models\Config;
use Closure;

class Permisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,  $rol)
    {

          if(!isset($_SESSION['token'])){
            return redirect()->intended(env('URL_APP').'/login');
            //return redirect()->action('Login@index');
            exit();
          }

          if((isset($_SESSION['token']))&&(in_array($rol,$_SESSION['permisos']))&&($_SESSION['tyc'] != 'SI')){
              return redirect()->action('Login@tyc');
              exit();
          }

          if((isset($_SESSION['token']))&&(in_array($rol,$_SESSION['permisos']))&&($_SESSION['pass_chge'] == 10)){
              return redirect()->action('Login@pass_chge');
              exit();
          }

          if((isset($_SESSION['token']))&&(!in_array($rol,$_SESSION['permisos']))){
              return redirect()->action('Login@error403');
              exit();
          }

          if((isset($_SESSION['token']))&&(in_array($rol,$_SESSION['permisos']))&&($_SESSION['tyc'] == 'SI')&&($_SESSION['pass_chge'] == 11)){
              $_SESSION['hora_acceso']=time();
              Config::updateLogin($request, $rol);
              return $next($request);
          }

          if((isset($_SESSION['token']))&&($rol == true)){
              $_SESSION['hora_acceso']=time();
              Config::updateLogin($request, $rol);
              return $next($request);
          }

          return $next($request);
    }
}
