<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [
            'create-posts',
            'edit-posts',
            'delete-posts',
            'view-posts',
            'add-comments'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($permissions);

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo(['create-posts', 'edit-posts', 'view-posts']);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['view-posts', 'add-comments']);
    }
}
