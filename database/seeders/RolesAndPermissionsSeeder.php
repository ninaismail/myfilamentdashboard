<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        //Misc Permissions = standard user
        //$miscPermission = Permission::create(['name'=>'N/A']);

        //User Model
        $userPermission1 = Permission::create(['name'=>'create user']);
        $userPermission2 = Permission::create(['name'=>'read user']);
        $userPermission3 = Permission::create(['name'=>'edit user']);
        $userPermission4 = Permission::create(['name'=>'delete user']);

        //Role Model
        $rolePermission1 = Permission::create(['name'=>'create role']);
        $rolePermission2 = Permission::create(['name'=>'read role']);
        $rolePermission3 = Permission::create(['name'=>'edit role']);
        $rolePermission4 = Permission::create(['name'=>'delete role']);

        //Permission Model
        $permissionPermission1 = Permission::create(['name'=>'create permission']);
        $permissionPermission2 = Permission::create(['name'=>'read permission']);
        $permissionPermission3 = Permission::create(['name'=>'edit permission']);
        $permissionPermission4 = Permission::create(['name'=>'delete permission']);
       
        //Admins Model
        $adminPermission1 = Permission::create(['name'=>'create admin']);
        $adminPermission2 = Permission::create(['name'=>'read admin']);

        //Create Roles

        //Standard user Role
        //$userRole = Role::create(['name' => 'user'])->syncPermissions([
        //    $miscPermission
       // ]);
        //Super Admin Role
        $superadminRole = Role::create(['name' => 'super-admin'])->syncPermissions([
            $adminPermission1,
            $adminPermission2,
            $permissionPermission1,
            $permissionPermission2,
            $permissionPermission3,
            $permissionPermission4,
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,            
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $adminPermission1,
            $adminPermission2
        ]);
        //Admin Roles
        $adminRole = Role::create(['name' => 'admin'])->syncPermissions([
            $adminPermission1,
            $adminPermission2,
            $permissionPermission1,
            $permissionPermission2,
            $permissionPermission3,
            $permissionPermission4,
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,            
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $adminPermission1,
            $adminPermission2
        ]);
        //Moderator Roles
        $moderatorRole = Role::create(['name' => 'moderator'])->syncPermissions([
            $permissionPermission2,
            $userPermission2,
            $rolePermission2,
            $adminPermission1
        ]);
        //Developer Roles
        $developerRole = Role::create(['name' => 'developer'])->syncPermissions([
            $adminPermission1
        ]);   
        
        User::Create([
            'name'=>'super admin',
            'is_admin'=> 1,
            'email'=> 'superadmin@admin.com',
            'password'=>Hash::make('admin1234'),
            'remember_token'=> Str::random(10)
        ])->assignRole($superadminRole);   

        User::Create([
            'name'=>'admin',
            'is_admin'=> 1,
            'email'=> 'admin@admin.com',
            'password'=>Hash::make('admin1234'),
            'remember_token'=> Str::random(10)
        ])->assignRole($adminRole);    

        User::Create([
            'name'=>'developer',
            'is_admin'=> 0,
            'email'=> 'developer@admin.com',
            'password'=>Hash::make('admin1234'),
            'remember_token'=> Str::random(10)
        ])->assignRole($developerRole);         
        
        User::Create([
            'name'=>'moderator',
            'is_admin'=> 0,
            'email'=> 'moderator@admin.com',
            'password'=>Hash::make('admin1234'),
            'remember_token'=> Str::random(10)
        ])->assignRole($moderatorRole);

        // for($i=1;$i<10;$i++){
        //     User::Create([
        //         'name'=>'test'.$i,
        //         'is_admin'=> 0,
        //         'email'=> 'test'.$i.'@admin.com',
        //         'password'=>Hash::make('admin1234'),
        //         'remember_token'=> Str::random(10)
        //     ])->assignRole($userRole); 
        //}
    }
}
