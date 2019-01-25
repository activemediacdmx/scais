<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Login as ModelLogin;
use App\Models\Usuarios;
use App\Models\Sistemas;
use App\Models\Viewlog;
use App\Models\Viewauditoria;
use Helpme;

class Login extends Controller
{
    public function __construct()
    {
        $this->middleware('permiso:Login|force_all_sign_out', ['only' => ['modal_all_sign_out']]);
        $this->middleware('permiso:Login|force_sign_out', ['only' => ['sign_all_out','sign_out','modal_sign_out']]);
        $this->middleware('permiso:Login|salir', ['only' => ['keepAliveReset','salir','lockSession']]);
        $this->middleware('permiso:Login|loginlogger', ['only' => ['loginlogger','loginlogger_get']]);
        $this->middleware('permiso:Login|auditoria', ['only' => ['auditoria','auditoria_get', 'modal_auditoria']]);
    }

    public function index() {
      if(isset($_SESSION['token'])){
          return redirect()->action('Inicio@index');
          exit();
      }
      return view('login/index');
    }

    public function error403() { return view('plantilla/403'); }

    public function tyc() { return view('plantilla/tyc'); }

    public function pass_chge() {
      if(!isset($_SESSION['token'])){
          return redirect()->action('Login@index');
          exit();
      }else if($_SESSION['pass_chge'] == 11){
        return redirect()->action('Inicio@index');
        exit();
      }
      return view('plantilla/pass_chge');
    }

    public function logear(Request $request) { return ModelLogin::logear($request); }

    public function error404() { return view('plantilla/404_full'); }

    public function salir(){return ModelLogin::salir();}

    public function verifica_session() {return ModelLogin::verificarSession();}

    // No recuerdo por que dos funciones hacen los mismo :(

    public function keepAliveReset() { print json_encode(ModelLogin::keepAlive());}

    public function keepAlive() {print json_encode(ModelLogin::keepAlive());}

    public function modal_all_sign_out() { return view('modales/login/sign-all-out'); }

    public function sign_out($id_usuario){ print ModelLogin::signout($id_usuario); }

    public function modal_sign_out($id_usuario) {return view('modales/login/sign-out')->with('id_usuario', $id_usuario); }

    public function auditoria(){ return view('login/auditoria'); }

    public function auditoria_get(){ print json_encode(Viewauditoria::auditar()); }

    public function modal_auditoria($id_usuario) {

      $auditoria = Viewauditoria::descriptivo($id_usuario);
      return view('modales/login/modal_auditoria')->with('auditoria', $auditoria);

    }
    
    public function getAuditoriaUserDate($id_usuario,$date) {
        $auditoria = Viewauditoria::descriptivo($id_usuario, $date);
    }

    public function loginlogger() {
      $system_data = Sistemas::datos_sistema(1);
      $datos = [
          'system_data' => $system_data
      ];
      return view('login/logger')->with('datos', $datos);
    }

    public function loginlogger_get(){ print json_encode(Viewlog::logger()); }

    public function salirAlternativo() { return ModelLogin::salir();}

    public function lockSession()
    {
        $usuario = Usuarios::datos_usuario($_SESSION['id_usuario']);
        $perfil  = Usuarios::perfil_usuario($_SESSION['id_usuario']);
        if($perfil['avatar']){$avatar = Helpme::duplicatePublic($perfil['avatar'],'perfiles');}
        $usuario_menu_top = Usuarios::datos_usuario($_SESSION['id_usuario']);
        $correo = $_SESSION['correo'];
        $username = $_SESSION['usuario'];
        $usuario_name = $usuario_menu_top['nombres'];
        ModelLogin::salirDirect();
        $datos = [
            'usuario' => $usuario,
            'perfil' => $perfil,
            'avatar' => $avatar,
            'usuario_menu_top' => $usuario_menu_top,
            'correo' => $correo,
            'username' => $username,
            'usuario_name' => $usuario_name
        ];
        return view('login/lock')->with('datos', $datos);
    }


    public function recuperar_datos(Request $request)
    {
        $token = Helpme::token(62);
        $recuperar = ModelLogin::recuperar_datos($request->input('correo'),$token);

        $datamail['subject'] = 'Recuperación de cuenta';
        $datamail['plantilla'] = 'lostpassword';
        $datamail['destinatarios'] = array(
          $request->input('correo')
        );
        $datamail['body'] = array(
          'token' => $token,
          'usuario' => $recuperar[0]['usuario']
        );

        Helpme::sendMail($datamail);

        print json_encode($recuperar);
    }

    public function sign_all_out()
    {
        $whosLogin = ModelLogin::whoisLogged();

        foreach ($whosLogin as $logged){
            ModelLogin::signout($logged['id_usuario']);
        }
    }
}
