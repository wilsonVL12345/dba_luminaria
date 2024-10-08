<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role0 = Role::create(['name' => 'Admin']);
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Coordinador']);
        $role3 = Role::create(['name' => 'Tecnico']);
        $role4 = Role::create(['name' => 'Veedor']);

        Permission::create(['name' => 'index'])->assignRole([$role0, $role1, $role2, $role3, $role4]);

        // menu
        Permission::create(['name' => 'menu.dash', 'description' => 'Mostrar datos de dash'])->assignRole([$role0, $role1, $role4]);
        Permission::create(['name' => 'menu.usuarios', 'description' => 'Mostrar datos de usuarios'])->assignRole([$role0, $role1, $role4]);
        Permission::create(['name' => 'menu.realizarTrbajo', 'description' => 'Mostrar datos de realizarTrbajo'])->assignRole([$role2, $role3]);
        Permission::create(['name' => 'menu.agendar', 'description' => 'Mostrar datos de agendar'])->assignRole([$role0, $role1, $role3, $role2]);
        Permission::create(['name' => 'menu.dtEspera', 'description' => 'Mostrar datos de trEspera'])->assignRole([$role0, $role1, $role3, $role2, $role4]);
        Permission::create(['name' => 'menu.dtRealizado', 'description' => 'Mostrar datos de trRealizado'])->assignRole([$role0, $role1, $role3, $role2, $role4]);
        Permission::create(['name' => 'menu.proyAlmacen', 'description' => 'Mostrar datos de proyAlmacen'])->assignRole([$role0, $role1, $role3, $role2, $role4]);
        Permission::create(['name' => 'menu.proyEjecutadas', 'description' => 'Mostrar datos de proyEjecutadas'])->assignRole([$role0, $role1, $role3, $role2, $role4]);
        Permission::create(['name' => 'menu.proyAccLumRetiradas', 'description' => 'Mostrar datos de proyAccLumRetiradas'])->assignRole([$role0, $role1, $role3, $role2, $role4]);
        Permission::create(['name' => 'menu.inspEspera', 'description' => 'Mostrar datos de inspEspera'])->assignRole([$role0, $role1, $role3, $role2, $role4]);
        Permission::create(['name' => 'menu.inspRealizado', 'description' => 'Mostrar datos de inspRealizado'])->assignRole([$role0, $role1, $role3, $role2, $role4]);
        Permission::create(['name' => 'menu.equipamiento', 'description' => 'Mostrar datos de equipamiento'])->assignRole([$role0, $role1, $role3, $role2, $role4]);
        Permission::create(['name' => 'menu.accesorios', 'description' => 'Mostrar datos de accesorios'])->assignRole([$role0, $role1, $role3, $role2, $role4]);
        Permission::create(['name' => 'menu.detallesDistritos', 'description' => 'Mostrar datos de detallesDistritos'])->assignRole([$role0, $role1, $role3, $role2, $role4]);

        // permisos dashboard
        Permission::create(['name' => 'dashboard.show', 'description' => 'Mostrar datos de dashboard'])->assignRole([$role0, $role1, $role4]);


        // permisos usuarios
        Permission::create(['name' => 'user.show', 'description' => 'Mostrar user'])->assignRole([$role0, $role1, $role4]);
        Permission::create(['name' => 'user.edit', 'description' => 'editar user'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'user.create', 'description' => 'crear user'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'user.delete', 'description' => 'eliminar user'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'user.restablecer', 'description' => 'eliminar user'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'user.export', 'description' => 'eliminar user'])->assignRole([$role0, $role1]);


        // permisos Realiar trabajo ejecutar trabajo tecnicos
        Permission::create(['name' => 'realizar.show', 'description' => 'Mostrar realizar'])->assignRole([$role0, $role2, $role3]);
        Permission::create(['name' => 'realizar.edit', 'description' => 'editar realizar'])->assignRole([$role0, $role1, $role2]);
        Permission::create(['name' => 'realizar.delete', 'description' => 'eliminar realizar'])->assignRole([$role0, $role1, $role2]);
        Permission::create(['name' => 'realizar.export', 'description' => 'export realizar'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'realizar.install', 'description' => 'empezar mantenimientos'])->assignRole([$role0, $role1, $role3]);

        // permisos agendar
        Permission::create(['name' => 'agendar.show', 'description' => 'Mostrar agendar'])->assignRole([$role0, $role1, $role2, $role3]);

        // permisos detalles generales
        Permission::create(['name' => 'detallesGen.show', 'description' => 'Mostrar detallesGen'])->assignRole([$role0, $role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'detallesGen.edit', 'description' => 'editar detallesGen'])->assignRole([$role0, $role1, $role2, $role3]);
        Permission::create(['name' => 'detallesGen.delete', 'description' => 'eliminar detallesGen'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'detallesGen.export', 'description' => 'export detallesGen'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'detallesGen.report', 'description' => 'report detallesGen'])->assignRole([$role0, $role1]);

        // permisos Proyectos almacen  en espera y realizados 
        Permission::create(['name' => 'proyecto.show', 'description' => 'Mostrar proyecto'])->assignRole([$role0, $role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'proyecto.edit', 'description' => 'editar proyecto'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'proyecto.install', 'description' => 'instalar proyecto'])->assignRole([$role0, $role1, $role2, $role3]);
        Permission::create(['name' => 'proyecto.create', 'description' => 'crear proyecto'])->assignRole([$role0, $role1, $role2, $role3]);
        Permission::create(['name' => 'proyecto.delete', 'description' => 'eliminar proyecto'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'proyecto.export', 'description' => 'export proyecto'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'proyecto.report', 'description' => 'report proyecto'])->assignRole([$role0, $role1]);

        // permisos proyecto luminarias retiradas
        Permission::create(['name' => 'proyecto.Retirado.show', 'description' => 'Mostrar proyecto.Retirado'])->assignRole([$role0, $role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'proyecto.Retirado.edit', 'description' => 'editar proyecto.Retirado'])->assignRole([$role0, $role1, $role2]);
        Permission::create(['name' => 'proyecto.Retirado.create', 'description' => 'crear proyecto.Retirado'])->assignRole([$role0, $role1, $role2, $role3]);
        Permission::create(['name' => 'proyecto.Retirado.delete', 'description' => 'eliminar proyecto.Retirado'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'proyecto.Retirado.export', 'description' => 'export proyecto.Retirado'])->assignRole([$role0, $role1]);

        // permisos inspecciones
        Permission::create(['name' => 'inspecciones.show', 'description' => 'Mostrar inspecciones'])->assignRole([$role0, $role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'inspecciones.edit', 'description' => 'editar inspecciones'])->assignRole([$role0, $role1, $role2]);
        Permission::create(['name' => 'inspecciones.install', 'description' => 'instalar inspecciones'])->assignRole([$role0, $role2, $role3]);
        Permission::create(['name' => 'inspecciones.create', 'description' => 'crear inspecciones'])->assignRole([$role0, $role1, $role2, $role3]);
        Permission::create(['name' => 'inspecciones.delete', 'description' => 'eliminar inspecciones'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'inspecciones.export', 'description' => 'export inspecciones'])->assignRole([$role0, $role1]);

        // permisos equipos Equipamientos
        Permission::create(['name' => 'equipamiento.show', 'description' => 'Mostrar equipamiento'])->assignRole([$role0, $role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'equipamiento.edit', 'description' => 'editar equipamiento'])->assignRole([$role0, $role1, $role2]);
        Permission::create(['name' => 'equipamiento.create', 'description' => 'crear equipamiento'])->assignRole([$role0, $role1, $role2, $role3]);
        Permission::create(['name' => 'equipamiento.delete', 'description' => 'eliminar equipamiento'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'equipamiento.export', 'description' => 'export equipamiento'])->assignRole([$role0, $role1]);

        // permisos equipos Accesorios
        Permission::create(['name' => 'accesorios.show', 'description' => 'Mostrar accesorios'])->assignRole([$role0, $role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'accesorios.edit', 'description' => 'editar accesorios'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'accesorios.create', 'description' => 'crear accesorios'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'accesorios.delete', 'description' => 'eliminar accesorios'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'accesorios.export', 'description' => 'export accesorios'])->assignRole([$role0, $role1]);

        // permisos Reelevamiento
        Permission::create(['name' => 'Reelevamiento.show', 'description' => 'Mostrar Reelevamiento'])->assignRole([$role0, $role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'Reelevamiento.edit', 'description' => 'editar Reelevamiento'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'Reelevamiento.create', 'description' => 'crear Reelevamiento'])->assignRole([$role0, $role1, $role2, $role3]);
        Permission::create(['name' => 'Reelevamiento.delete', 'description' => 'eliminar Reelevamiento'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'Reelevamiento.export', 'description' => 'export Reelevamiento'])->assignRole([$role0, $role1]);

        // permisos Distritos Urbanizaciones
        Permission::create(['name' => 'Distritos.show', 'description' => 'Mostrar Distritos'])->assignRole([$role0, $role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'Distritos.edit', 'description' => 'editar Distritos'])->assignRole([$role0, $role1, $role2]);
        Permission::create(['name' => 'Distritos.create', 'description' => 'crear Distritos'])->assignRole([$role0, $role1, $role2, $role3]);
        Permission::create(['name' => 'Distritos.delete', 'description' => 'eliminar Distritos'])->assignRole([$role0, $role1]);
        Permission::create(['name' => 'Distritos.export', 'description' => 'export Distritos'])->assignRole([$role0, $role1]);
    }
}
