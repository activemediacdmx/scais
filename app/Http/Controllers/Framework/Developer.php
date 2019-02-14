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

    static public function test(){

        $sistemas = SysUsr::getSysOfUser(1);
        foreach ($sistemas as $sistema) {
          echo $sistema->id_sistema;
        }

    }



}
