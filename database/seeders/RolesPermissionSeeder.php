<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Super Administrador
        $permissionsSuperAdmin = [
            'rol.ver',
            'rol.crear',
            'rol.editar',
            'rol.eliminar',

            'usuario.ver',
            'usuario.crear',
            'usuario.editar',
            'usuario.eliminar',

            'dashboard.ver',
        ];

        foreach ($permissionsSuperAdmin as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        $roleSuperAdmin = \Spatie\Permission\Models\Role::create(['name' => 'super administrador']);

        $roleSuperAdmin->syncPermissions(\Spatie\Permission\Models\Permission::all());

        $user = User::where('email', 'admin@example.com')->first();

        $user->assignRole($roleSuperAdmin);

        // Administrador
        $roleAdmin = \Spatie\Permission\Models\Role::create(['name' => 'administrador']);

        $roleAdmin->syncPermissions(\Spatie\Permission\Models\Permission::where('name', 'usuario.*')->get());
    }
}
