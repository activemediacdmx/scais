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
use DB;

class Developer extends Controller
{
    public function __construct()
    {
        $this->middleware('permiso:Developer|index', ['only' => ['index','test']]);
    }

    public function index() {
      return view('developer/index');
    }

    static public function test(){

          $query_resp = DB::table('fw_usuarios')
                  ->where('id_usuario', 1)
                  ->update([
                      'token'=> Helpme::token(32),
                      'user_mod'=> $_SESSION['id_usuario']
                  ]);


            $i = Usuarios::updateRemoteUser(1, 2);
            dd($i);

    }



}
