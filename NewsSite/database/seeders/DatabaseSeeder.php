<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // Тестовые пользователи
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $adminUser->assignRole('admin');

        $editorUser = User::create([
            'name' => 'Editor',
            'email' => 'editor@example.com',
            'password' => Hash::make('password')
        ]);
        $editorUser->assignRole('editor');

        $regularUser = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password')
        ]);
        $regularUser->assignRole('user');
    }
}
