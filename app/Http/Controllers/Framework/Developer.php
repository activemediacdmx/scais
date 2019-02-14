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
        $this->middleware('permiso:Developer|index', ['only' => ['index','test']]);
    }

    public function index() {
      return view('developer/index');
    }

    static public function test(){
      $i = SysUsr::getRolOfUserSys(1, 2);
      dd($i->id_rol);
    }



}
