<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Login;
use Helpme;

class Webhook extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Webwook|index', ['only' => ['index']]);
  }
  static public function index(){}

  static public function auth(){
    $app_secret = 'MY_SECRET';
		$webhook_signature = $_SERVER ['HTTP_SYSTEMVERIFY_SIGNATURE'];
		$body = file_get_contents('php://input');
		$expected_signature = hash_hmac( 'sha256', $body, $app_secret, false );

		if($webhook_signature == $expected_signature) {

      header("Post:".$webhook_signature);
			header("Status: 200 OK!");

		} else {
			header("Status: 401 Not authenticated");
		}
  }
}
