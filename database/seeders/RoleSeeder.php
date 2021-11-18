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
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Gerente']);
        $role3 = Role::create(['name' => 'Sub']);

        Permission::create(['name' => 'admin.home',
                            'description' => 'Acceder a Home'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.users.index',
                            'description' => 'Ver Listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 
                            'description' => 'Crear Un rol y agregar permisos al rol'])->syncRoles([$role1]);
        //Permission::create(['name' => 'admin.users.update'
                            //''])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.index',
                            'description' => 'Ver listado de Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.create',
                            'description' => 'Crear Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit', 
                            'description' => 'Editar roles'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.gerencias.index',
                            'description' => 'Ver listado de gerencias'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.gerencias.create',
                            'description' => 'Crear gerencias'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.gerencias.edit', 
                            'description' => 'Editar gerencias'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.gerencias.destroy',  
                            'description' => 'Eliminar gerencias'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.coordinaciones.index',
                            'description' => 'Ver listado de coordinaciones'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.coordinaciones.create',  
                            'description' => 'Crear coordinaciones'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.coordinaciones.edit',
                            'description' => 'Editar coordinaciones'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.coordinaciones.destroy', 
                            'description' => 'Eliminar coordinaciones'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.objetivos.index',
                            'description' => 'Ver listado de objetivos'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.objetivos.create',
                            'description' => 'Crear objetivos'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.objetivos.edit', 
                            'description' => 'Editar Objetivos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.objetivos.destroy',  
                            'description' => 'Eliminar objetivos'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.metas.index',
                            'description' => 'Ver listado de metas'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.metas.create',
                            'description' => 'Crear metas'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.metas.edit', 
                            'description' => 'Editar metas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.metas.destroy',  
                            'description' => 'Eliminar metas'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.actividades.index',
                            'description' => 'Ver listado de actividades'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.actividades.create',
                            'description' => 'Crear actividades'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.actividades.edit', 
                            'description' => 'Editar actividades'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.actividades.destroy',  
                            'description' => 'Eliminar actividades'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.charts.index',
                            'description' => 'Ver / Generar Graficos'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.planificaciones.index',
                            'description' => 'Ver listado de planificaciones especificas'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.planificaciones.create',
                            'description' => 'Crear planificaciones especificas'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.planificaciones.edit', 
                            'description' => 'Editar planificaciones especificas'])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'admin.desgloses.index',
                            'description' => 'Ver listado Desglose de lo Programado'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.desgloses.create',
                            'description' => 'Crear Desglose de lo Programado'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.desgloses.edit', 
                            'description' => 'Editar Desglose de lo Programado'])->syncRoles([$role1, $role2]);
       

        
    }
}