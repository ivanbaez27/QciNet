<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Coordinador']);
        $role3 = Role::create(['name' => 'Estudiante']);

        Permission::create(['name' => 'Ver usuarios'])->assignRole($role1);
        //Permission::create(['name' => 'Crear usuarios'])->assignRole($role1);
        Permission::create(['name' => 'Editar usuarios'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'Eliminar usuarios'])->syncRoles([$role1, $role2, $role3]);
        

        Permission::create(['name' => 'Ver carreras'])->assignRole($role1);
        Permission::create(['name' => 'Crear carreras'])->assignRole($role1);
        Permission::create(['name' => 'Editar carreras'])->assignRole($role1);
        Permission::create(['name' => 'Eliminar carreras'])->assignRole($role1);

        Permission::create(['name' => 'Ver publicacion'])->syncRoles($role1);
        Permission::create(['name' => 'Crear publicacion'])->assignRole($role2);
        Permission::create(['name' => 'Editar publicacion'])->assignRole($role2);
        Permission::create(['name' => 'Eliminar publicacion'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'Ver comentario'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'Crear comentario'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar comentario'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'Eliminar comentario'])->syncRoles([$role1, $role2, $role3]);

    }
}
