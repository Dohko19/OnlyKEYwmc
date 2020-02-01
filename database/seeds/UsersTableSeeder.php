<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Daniel";
        $user->email = "admin@email.com";
        $user->password = "123123";
        $user->save();

        $roleAdmin = new Role;
        $roleAdmin->name = 'admin';
        $roleAdmin->display_name = 'Administrador del Sitio';
        $roleAdmin->descripcion = 'Permisos Completos para el Sitio';
        $roleAdmin->save();

        $user->roles()->attach($roleAdmin);

        $role = new Role;
        $role->name = 'dgral';
        $role->display_name = 'Direccion General';
        $role->descripcion = 'Director General acceso a todas las marcas y sucursales';
        $role->save();

        $role = new Role;
        $role->name = 'dmarca';
        $role->display_name = 'Direccion Marca';
        $role->descripcion = 'Director de Marca acceso a sus propias marcas y sucursales';
        $role->save();

        $role = new Role;
        $role->name = 'gzona';
        $role->display_name = 'Gerente Zona';
        $role->descripcion = 'Gerente de Zona podra ver las sucursales de su zona';
        $role->save();

        $role = new Role;
        $role->name = 'gsucursal';
        $role->display_name = 'Gerente de Sucursal';
        $role->descripcion = 'Gerente de Sucursal con acceso a su Sucursal';
        $role->save();

        $role = new Role;
        $role->name = 'asesor';
        $role->display_name = 'Asesor';
        $role->descripcion = 'Asesor puede ver planes de Accion de acuerdo a la sucursal Auditada';
        $role->save();
     }
}
