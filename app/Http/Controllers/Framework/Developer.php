<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Login as ModelLogin;
use App\Models\Usuarios;
use App\Models\Sistemas;
use App\Models\Viewlog;
use App\Models\Roles;
use App\Models\Viewauditoria;
use App\Models\Systemsystemusers as SysUsr;
use Helpme;

class Developer extends Controller
{
    public function __construct()
    {
        $this->middleware('permiso:Developer|index', ['only' => ['index']]);
    }

    public function index() {
      return view('developer/index');
    }

    static public function test($id_rol = 2){
      self::getSysOfRoles($id_rol);
    }

    static function getSysOfRoles($id_rol){
        $roles = SysUsr::getSysOfRoles($id_rol);
        foreach($roles as $role){
          SysUsr::updateRelationStatus($id_rol, $role->id_sistema, 18);

          if(self::updateRemoteRole($id_rol, $role->id_sistema))
            SysUsr::updateRelationStatus($id_rol, $role->id_sistema, 3);
        }
    }

    static public function updateRemoteRole($id_rol, $id_sistema){
      $keys = Sistemas::systemKey($id_sistema);

      foreach ($keys as $key)
      {
          $app_secret =  $key->system_key;
          $app_name =  $key->nombre;
          $app_url =  $key->url;
      }

      $updated =  self::updateRemoteRole_do($app_url, $app_secret, $app_name, $id_rol, $id_sistema);
      $valid = ($updated >= 1)?true:false;
      return $valid;
    }

    static private function updateRemoteRole_do($app_url, $app_secret, $app_name, $id_rol, $id_sistema){

      $rol_data = json_encode(Roles::getDataRol($id_rol));

      $post_send = json_encode(array('proceso' => 'updateroldata', 'roldata' => $rol_data));
      $sign = hash_hmac('sha256', $post_send, $app_secret, false);

      $headers = array(
         'systemverify-Signature:'.$sign,
         'system:'.$app_name,
         'system-id:'.$id_sistema,
         'ip:'.$_SERVER['REMOTE_ADDR'],
         'roldata:'.$rol_data
      );

      $curl = null;
      $curl = curl_init($app_url.'webhook/updateroldata');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_HEADER, 1);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $post_send);

      $res = curl_exec($curl);
      $data = explode("\r\n",$res);
      $status = $data[0];
      //return $data[10];
      dd($res);
    }



}
