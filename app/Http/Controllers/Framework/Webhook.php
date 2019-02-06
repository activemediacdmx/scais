<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Sistemas;
use App\Models\Controllers;
use App\Models\Roles;
use App\Models\Accesos;
use Helpme;

class Webhook extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Webwook|index', ['only' => ['index']]);
  }
  static public function index(){}

  static public function auth(){

      $id_sistema = $_SERVER ['HTTP_SYSTEM_ID'];
      $keys = Sistemas::systemKey($id_sistema);
      foreach ($keys as $key)
      {
          $app_secret =  $key->system_key;
      }
  		$webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $remote_ip = $_SERVER ['HTTP_IP'];
  		$body = file_get_contents('php://input');
  		$expected_signature = hash_hmac( 'sha256', $body, $app_secret, false );

  		if($webhook_signature == $expected_signature) {

          $data = json_decode($body);
          $loginData = Login::logearClienteRemoto($data->usuario,$data->password,$remote_ip,$id_sistema);
          $loginData = json_encode($loginData);

        header($loginData);
  			header("Status: 200 OK!");

  		} else {
  			header("Status: 401 Not authenticated".$app_secret);
  		}

  }

  static public function sendModelsSystem(){

      $id_sistema = $_SERVER ['HTTP_SYSTEM_ID'];
      $keys = Sistemas::systemKey($id_sistema);
      foreach ($keys as $key)
      {
          $app_secret =  $key->system_key;
      }
      $webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
      $remote_ip = $_SERVER ['HTTP_IP'];
      $body = file_get_contents('php://input');
      $expected_signature = hash_hmac( 'sha256', $body, $app_secret, false );

      if($webhook_signature == $expected_signature) {


        $result = json_decode($body, true);
        $result = json_decode($result['ids_inserts'], true);

        $metodos = $result['ids_metodos'];
        $roles = $result['ids_roles'];
        $accesos = $result['ids_permisos'];


        $metodos = Controllers::getAll($metodos);
        $roles = Roles::getAll($roles);
        $accesos = Accesos::getAll($accesos);

        $datos = [
            'metodos' => json_encode($metodos),
            'roles' => json_encode($roles),
            'accesos' => json_encode($accesos)
        ];

        $header_send = base64_encode(json_encode($datos));

        echo $header_send;

      } else {
        header("Status: 401 Not authenticated");
      }

  }

}
