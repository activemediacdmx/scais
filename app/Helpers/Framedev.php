<?php
//app/Helpers/Framedev.php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Framedev {
    /**
     * @param int $user_id User-id
     *
     * @return string
     */
    public static function ejemplo_query_builder($user_id) {
        $user = DB::table('users')->where('userid', $user_id)->first();

        return (isset($user->username) ? $user->username : '');
    }
    public static function ipv4to6($ip = NULL) {
      $ip =($ip === NULL)?$_SERVER['REMOTE_ADDR']:$ip;
      $ipAddressBlocks = explode('.', $ip);
      if (count($ipAddressBlocks) == 0) {
        return;
      }
      $ipv6       = '';
      $ipv6Pieces = 0;
      foreach ($ipAddressBlocks as $ipAddressBlock) {
        if ($ipv6Pieces%4 == 0 && $ipv6Pieces > 0) {
          $ipv6 .= '::';
        }
        $ipv6Piece = dechex($ipAddressBlock);
        $ipv6 .= (is_numeric($ipv6Piece) && $ipv6Piece < 10 ? '0'.$ipv6Piece : $ipv6Piece);
        $ipv6Pieces = strlen(str_replace('::', '', $ipv6));
      }
      return $ipv6.'::/48';
    }

    public static function setOption($arreglo,$id){
      $opciones = "<option disabled selected value=''>Seleccione...</option>";
      for($i=0;$i<count($arreglo);$i++){
        if($id==""){
            $opciones .=  "<option value='".$arreglo[$i]['value']."'>".ucwords($arreglo[$i]['valor'])."</option>";
        }else{
          if($id==$arreglo[$i]['value']){
            $opciones .=  "<option value='".$arreglo[$i]['value']."' selected>".ucwords($arreglo[$i]['valor'])."</option>";
          }else{
            $opciones .=  "<option value='".$arreglo[$i]['value']."'>".ucwords($arreglo[$i]['valor'])."</option>";
          }
        }
      }
      return $opciones;
    }
    public static function sendMail($datamail){
      include_once("../vendor/visualmx/mail/Email.php");
      $correo = new Email();
      $correo->envia_correo($datamail);
    }
    public static function tiene_permiso($levels=0){
      if(isset($_SESSION['token'])){
        if(!in_array($levels,$_SESSION['permisos'])){
          $permiso = false;
        }else{
          $permiso = true;
        }
        return $permiso;
      }else{
        $permiso = false;
      }
      }
    public static function token($long=25){
      $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
      mt_srand((double)microtime()*1000000);
      $i=0;
      $pass = '';
      while ($i != $long) {
        $rand=mt_rand() % strlen($chars);
        $tmp=$chars[$rand];
        $pass=$pass . $tmp;
        $chars=str_replace($tmp, "", $chars);
        $i++;
      }
      return strrev($pass);
    }
    public static function descargar_archivo($archivo) {
      if (file_exists($archivo)) {
        $filename = basename($archivo);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($archivo));
        ob_clean();
        flush();
        readfile($archivo);
      }
    }
    public static function diferenciaFechas($init,$end){
      $DateTime1 = new \DateTime($init);
      $DateTime2 = new \DateTime($end);
      $dteDiff = $DateTime1->diff($DateTime2);
      return $dteDiff->format("%H:%I:%S");
    }

    public static function diferenciaFechasD($init,$end){
      $DateTime1 = new \DateTime($init);
      $DateTime2 = new \DateTime($end);
      $dteDiff = $DateTime1->diff($DateTime2);
      return $dteDiff->format("0000-%M-%D %H:%I:%S");
    }
    public static function diferenciaSegundos($init,$end){
      $segundos = strtotime($end) - strtotime($init);
      return $segundos;
    }
    public static function duplicatePublic($imagen,$newfldr){
      $token = self::token();
      $destino = $token.$imagen;

      $tmp = '../public/tmp/';
      $files = scandir($tmp);
      foreach($files as $file){
        if ((is_file($tmp.$file))&&($file != '.gitkeep')) {
          unlink($tmp.$file);
        }
      }

      $cache = '../public/plugs/cache/';
      $filesc = scandir($cache);
      foreach($filesc as $filec){
        if ((is_file($cache.$filec))&&($filec != '.gitkeep')) {
          unlink($cache.$filec);
        }
      }
      copy('../storage/'.$newfldr.'/'.$imagen, $tmp.$destino);
      return $destino;
    }
     public static function getYearsOld($date) {
       list($Y,$m,$d) = explode("-",$date);
       return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
     }
     public static function getBooleanStatus($status){
       return ($status==1)?'Si':'No';
     }
     public static function toArray($data){
         return json_decode(json_encode($data), true);
     }
     public static function pad_left($valor,$num_total,$fill){
       return (!empty(trim($valor)))?str_pad($valor, $num_total, $fill , STR_PAD_LEFT):'';
     }
     public static function pad_right($valor,$num_total,$fill){
       return (!empty(trim($valor)))?str_pad($valor, $num_total, $fill , STR_PAD_RIGHT):'';
     }
}
