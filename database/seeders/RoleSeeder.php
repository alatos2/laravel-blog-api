<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create roles
        $admin = Role::create(['name' => 'admin']);
        $author = Role::create(['name' => 'author']);
        $reader = Role::create(['name' => 'reader']);

        //create permissions
        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'approve comments',
            'manage users',
            'manage categories',
            'manage tags'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin->givePermissionTo($permissions);

        $author->givePermissionTo([
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts'
        ]);

        $reader->givePermissionTo([]);
    }
}
