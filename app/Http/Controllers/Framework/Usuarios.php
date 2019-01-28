<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usuarios as ModelUsuarios;
use App\Models\Roles;
use App\Models\Viewlogins;
use App\Models\Viewusuarios;
use App\Models\Ubicacion;
use App\Models\Sistemas;
use Helpme;

class Usuarios extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Usuarios|index', ['only' => ['index']]);
      $this->middleware('permiso:Usuarios|logueados', ['only' => ['logueados','logueados_get']]);
      $this->middleware('permiso:Usuarios|obtener_usuarios', ['only' => ['obtener_usuarios']]);
      $this->middleware('permiso:Usuarios|desbloquea_usuario', ['only' => ['desbloquea_usuario']]);
      $this->middleware('permiso:Usuarios|desbloquear_usuarios', ['only' => ['desbloquear_usuarios']]);
      $this->middleware('permiso:Usuarios|upload_avatar', ['only' => ['update_avatar','exit_status','get_extension','smart_rename']]);
      $this->middleware('permiso:Usuarios|datos_usuario', ['only' => ['datos_usuario']]);
      $this->middleware('permiso:Usuarios|modal_add_usr', ['only' => ['modal_add_usr']]);
      $this->middleware('permiso:Usuarios|agregar_usuario', ['only' => ['agregar_usuario']]);
      $this->middleware('permiso:Usuarios|editar_usuario', ['only' => ['editar_usuario']]);
      $this->middleware('permiso:Usuarios|editar_perfil', ['only' => ['editar_perfil']]);
      $this->middleware('permiso:Usuarios|baja_usuario', ['only' => ['baja_usuario']]);
      $this->middleware('permiso:Usuarios|perfil', ['only' => ['se_requiere_logueo']]);
  }

  public function editar_usuario(Request $request) { print json_encode(ModelUsuarios::editar_usuario($request)); }

  public function logueados() {
    $system_data = Sistemas::datos_sistema(1);
    $datos = [
        'system_data' => $system_data
    ];
    return view('usuarios/logueados')->with('datos', $datos);
  }

  public function logueados_get() { print json_encode(Viewlogins::logueados_get()); }

  public function tyc($stat){print json_encode(ModelUsuarios::acceptTyc($stat));}

  public function update_avatar($file){ return ModelUsuarios::set_avatar($file);}

  public function agregar_usuario(Request $request) {print json_encode(ModelUsuarios::agregar_usuario($request));}

  public function desbloquear_usuarios(){print json_encode(ModelUsuarios::desbloquear_usuarios());}

  public function index(){
    $system_data = Sistemas::datos_sistema(1);
    $datos = [
        'system_data' => $system_data
    ];
    return view('usuarios/usuarios')->with('bloqueados', ModelUsuarios::usuarios_bloqueados())->with('datos', $datos);
  }

  public function obtener_usuarios(){print json_encode(Viewusuarios::obtener_usuarios());}

  public function desbloquea_usuario($id){print json_encode(ModelUsuarios::desbloquea_usuario($id));}

  public function editar_perfil(Request $request){print json_encode(ModelUsuarios::editar_perfil($request));}

  public function baja_usuario($id){print json_encode(ModelUsuarios::baja_usuario($id));}

  public function datos_usuario($user_id)
  {
      $usuario = ModelUsuarios::datos_usuario($user_id);
      $ubicacion = Ubicacion::select_ubicaciones($usuario['id_ubicacion']);
      $roles = Roles::selectRolesByTipo('8,6',$_SESSION['id_rol'],$usuario['id_rol']);
      if(($usuario['cat_status'])==3){$chk_cat_status = "checked";$cat_status = 3;}else{$chk_cat_status = "";$cat_status = $usuario['cat_status'];}
      if(($usuario['cat_pass_chge'])==10){$chk_change_pass = "checked";$change_pass = 10;}else{$chk_change_pass = "";$change_pass = $usuario['cat_pass_chge'];}
      $datos = [
          'usuario' => $usuario,
          'ubicacion' => $ubicacion,
          'roles' => $roles,
          'chk_cat_status' => $chk_cat_status,
          'cat_status' => $cat_status,
          'chk_change_pass' => $chk_change_pass,
          'change_pass' => $change_pass
      ];
      return view('modales/usuarios/editar_usuario')->with('datos', $datos);
  }

  public function modal_add_usr()
  {
      $ubicacion = Ubicacion::select_ubicaciones('');
      $roles = Roles::selectRolesByTipo('8,6',$_SESSION['id_rol']);
      $datos = [
          'ubicacion' => $ubicacion,
          'roles' => $roles
      ];
      return view('modales/usuarios/nuevo_usuario')->with('datos', $datos);
  }
  private function exit_status($str)
  {
    if($str){
      echo json_encode(array('status'=>$str));
      exit;
    }
  }
  private function get_extension($file_name)
  {
    if($file_name){
      $ext = explode('.', $file_name);
      $ext = array_pop($ext);
      return strtolower($ext);
    }
  }
  private function smart_rename($ruta)
  {
    if($ruta){
      $elemento = pathinfo($ruta);
      $hash = Helpme::token(3);
      $new_file = $elemento['dirname'].'/'.$elemento['filename'].'_'.$hash.'.'.$elemento['extension'];
      if (file_exists($new_file)){
        $new_file = self::smart_rename($new_file);
      }else{
        return $new_file;
      }
    }
  }

  public function resetpassword($token)
  {
      if(!$token){Header("Location: ".URL_APP."login"); exit();}
      $token_valid = ModelUsuarios::verifica_token($token);
      if($token_valid['valid']){
        return view('login/restore');
      }else{
        return redirect()->action('Login@index');
      }
  }

  public function cambiar_password(Request $request)
  {

      $_SESSION['pass_chge'] = 11;
      if(($request->input('password1') == $request->input('password2'))&&($request->input('password1'))){
        $chge_pass = ModelUsuarios::cambiar_password($request->input('password1'),$_SESSION['id_usuario']);
      }

      \Debugbar::info('>'.$chge_pass);

      if($chge_pass >= 0){
        $set_pass_chge = ModelUsuarios::pass_chge_stat(11,$_SESSION['id_usuario']);
        \Debugbar::info('>>'.$set_pass_chge);
        if($set_pass_chge >= 0){
          $respuesta = array('resp' => true , 'dispositivo' => $_SESSION['dispositivo'] );
        }else{
          $_SESSION['pass_chge'] = 10;
          $respuesta = array('resp' => false ,'oper' => 'x', 'dispositivo' => $_SESSION['dispositivo'] );
        }
      }else{
        $_SESSION['pass_chge'] = 10;
        $respuesta = array('resp' => false ,'oper' => 'y', 'dispositivo' => $_SESSION['dispositivo'] );
      }
      print json_encode($respuesta);
  }

  public function perfil()
  {
      $usuario = ModelUsuarios::datos_usuario($_SESSION['id_usuario']);
      $perfil  = ModelUsuarios::perfil_usuario($_SESSION['id_usuario']);

        if($perfil['avatar']){
            $avatar = Helpme::duplicatePublic($perfil['avatar'],'perfiles');
        }

      $rol = Roles::rol();
      $system_data = Sistemas::datos_sistema(1);

      $datos = [
          'usuario' => $usuario,
          'rol' => $rol,
          'avatar' => $avatar,
          'perfil' => $perfil,
          'system_data' => $system_data
      ];
      return view('usuarios/perfil')->with('datos', $datos);
  }
  public function upload_dropzone($folder,$permisos){
    if(Helpme::tiene_permiso('Usuarios|'.$permisos)){
      $newfldr = str_replace('|', '/', $folder);
      $upload_dir = '../storage/'.$newfldr.'/';

      if(!is_dir($upload_dir)){
        if(!mkdir($upload_dir, 0777, true)) {
            Debugbar::info('Error al crear la estructura del directorio');
            exit();
        }
      }

      $allowed_ext = array('jpg','jpeg','png','gif','pdf');

      if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
        Debugbar::info('Error! Error en el metodo HTTP!'.$_SERVER['REQUEST_METHOD']);
      }

      if(((strpos($_FILES['file']['type'], 'image') !== false) ||
          (strpos($_FILES['file']['type'], 'application/pdf') !== false)) && $_FILES['file']['error'] == 0 ){
        $pic = $_FILES['file'];


        /*
        $allowed_ext = array('jpg','jpeg','png','gif');

        if(!in_array(self::get_extension($pic['name']),$allowed_ext)){
          Debugbar::info('Solo las extensiones '.implode(',',$allowed_ext).' son permitidas!');
        }
        */
        $extension_or = pathinfo($pic['name']);
        $destino_final = $upload_dir.Helpme::token(6).'.'.$extension_or['extension'];
        if (file_exists($destino_final)){
          $destino_final = self::smart_rename($destino_final);
        }
        if(move_uploaded_file($pic['tmp_name'], $destino_final)){
          $elemento = pathinfo($destino_final);
          $extension = $elemento['extension'];
          $nombre = $elemento['filename'];
          $original = $nombre.'.'.$extension;
          $temporal =  Helpme::duplicatePublic($original,$newfldr);
          echo $temporal.'|'.$original;
        }
      }else{
        Debugbar::info('Algunos errores ocurrieron al actualizar el avatar: '.strpos($_FILES['file']['type'], 'image'));
      }
    }else{
      return redirect()->action('Login@error403');
      exit();
    }
  }
}
