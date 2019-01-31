<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('populateCatalogo');
        $this->call('populateAcceso');
        $this->call('populateConfig');
        $this->call('populateUbicaciones');
        $this->call('populateSistemas');
        $this->call('populateMetodos');
        $this->call('populateMetodosExternos');
        $this->call('populateRoles');
        $this->call('populateUsuarios');
        $this->call('populateUsuariosConfig');
        $this->call('populatePermisos');
    }
}
