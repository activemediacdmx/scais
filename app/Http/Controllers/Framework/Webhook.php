<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Sistemas;
use Helpme;

class Webhook extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Webwook|index', ['only' => ['index']]);
  }
  static public function index(){}

  static public function auth(){

      $keys = Sistemas::systemKey($_SERVER ['HTTP_SYSTEM']);
      foreach ($keys as $key)
      {
          $app_secret =  $key->system_key;
          $id_sistema =  $key->id_sistema;
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
}
