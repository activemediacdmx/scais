<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Config extends Model
{
  protected $table = 'fw_config';
  protected $primaryKey = 'id_config';
  public $timestamps = false;

  static function updateLogin($request, $rol){

      DB::table('fw_login')
          ->where('id_usuario', $_SESSION['id_usuario'])
          ->where('open', 1)
          ->update(['ultima_verificacion' => date("Y-m-d H:i:s")]);

      $metodo = (isset($request->segments()[1]))?$request->segments()[1]:'index';

      //\Debugbar::info($_SESSION['accessid']);
      DB::table('fw_auditoria')->insert(
          [
              'id_metodo' => $_SESSION['accessid'][strtolower($rol)],
              'permiso' => $rol,
              'controlador' => $request->segments()[0],
              'metodo' => $metodo,
              'post' => @json_encode($request->post()),
              'headers' => json_encode($request->headers->all()),
              'server' => json_encode($request->server->all()),
              'session' => json_encode($request->getSession()->all()),
              'ip' => $request->getClientIp(),
              'url' => $request->url(),
              'path' => $request->path(),
              'method' => $request->method(),
              'token_session' => $_SESSION['token'],
              'user_alta' => $_SESSION['id_usuario'],
              'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );

/*
          'controlador' => $request->segments(),
          'controlador_metodo' => $request->segments(),
          'post' => $request->post(),
          'headers' => $request->headers,
          'server' => $request->server,
          'ip' => $request->getClientIp(),
          'ips' => $request->getClientIps(),
          'session' => $request->session(),
          'url' => $request->url(),
          'path' => $request->path(),
          'method' => $request->method(),
          'token_session' => $_SESSION['token'],
          'usuario' => $_SESSION['usuario'],
          'user_alta' => $_SESSION['id_usuario'],
          'fecha_alta' => date("Y-m-d H:i:s")

*/
      //insertar registro de actividad
      //$i = json_encode($request->post());
      //$i = $request->post();
      //$i = $request->path();
      //$i = $request->url();
      //$i = $request->fullUrl();
      //$i = $request->method();
      //$request->isMethod('post');
      //$request->input();
      //$i = $request->all();
      //$i = $request->flash();
      //$request->capture()->headers
      //$request->root()
      //$array = array('1','2');
      //$request->fullUrlWithQuery($array)
      //$request->decodedPath()
      //$request->segments()
      //$request->ajax()
      //$request->headers
                        //cookie
                        //accept-language
                        //accept-encoding
                        //referer
                        //content-type
                        //user-agent
                        //x-requested-with
                        //x-csrf-token
                        //origin
                        //accept
                        //content-length
                        //connection
                        //host
                        //$request->capture()->headers->get('connection')
      //$request->server
                        //userResolver
                        //HOME
                        //HTTP_COOKIE
                        //HTTP_ACCEPT_LANGUAGE
                        //HTTP_ACCEPT_ENCODING
                        //HTTP_REFERER
                        //HTTP_CONTENT_TYPE
                        //HTTP_USER_AGENT
                        //HTTP_X_REQUESTED_WITH
                        //HTTP_X_CSRF_TOKEN
                        //HTTP_ORIGIN
                        //HTTP_ACCEPT
                        //HTTP_CONTENT_LENGTH
                        //HTTP_CONNECTION
                        //HTTP_HOST
                        //REDIRECT_STATUS
                        //SERVER_NAME
                        //SERVER_PORT
                        //SERVER_ADDR
                        //REMOTE_PORT
                        //REMOTE_ADDR
                        //SERVER_SOFTWARE
                        //GATEWAY_INTERFACE
                        //REQUEST_SCHEME
                        //SERVER_PROTOCOL
                        //DOCUMENT_ROOT
                        //DOCUMENT_URI
                        //REQUEST_URI
                        //SCRIPT_NAME
                        //CONTENT_LENGTH
                        //CONTENT_TYPE
                        //REQUEST_METHOD
                        //QUERY_STRING
                        //SCRIPT_FILENAME
                        //PATH_INFO
                        //FCGI_ROLE
                        //PHP_SELF
                        //REQUEST_TIME_FLOAT
                        //REQUEST_TIME
                        //$request->server->get('USER')
     //$request->getClientIp()
     //$request->getClientIps()
     //$request->getClientIps()[0]
     //$request->session()
     //$request->fingerprint()
  }

  static function getConfig($id_site,$config){

        $result = Config::where('id_site', '=', $id_site)
              ->where('descripcion', '=', $config)
              ->select('valor','tmp_val as temporal','data')
              ->get();

        $array = array();

        if(count($result)>=1){
          foreach ($result as $row) {
            $array['valor']=$row->valor;
            $array['temporal']=$row->temporal;
            $array['datos']=$row->datos;
          }
        }
        return $array;
  }
  static function existConfig($data){

   $result = Config::where('id_site', '=', $id_site)
         ->where('descripcion', '=', $data['descripcion'])
         ->select('id_config')
         ->get();

   if(count($result)>=1){
     $return = true;
   }else{
     $return = false;
   }
   return $return;
  }
  static function setConfig($data){
   $exist = self::existConfig($data);
   if(!$exist){

     $store = new Config;
     $store->id_site = $data['id_site'];
     $store->descripcion = $data['descripcion'];
     $store->valor = $data['valor'];
     $store->tmp_val = $data['tmp_val'];
     $store->data = $data['data'];
     $store->user_alta = $_SESSION['id_usuario'];
     $store->fecha_alta = date("Y-m-d H:i:s");
     $store->save();

   }else{
     Config::where('id_site', '=', $data['id_site'])
               ->where('descripcion','=',$data['descripcion'])
               ->update(array(
                    'valor' => $data['valor'],
                    'tmp_val' => $data['tmp_val'],
                    'data' => $data['data'],
                    'user_mod' => $_SESSION['id_usuario'],
                    'fecha_mod' => NOW()
                  ));
   }
  }
}
