<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Client;
use App\Models\Employee;
use App\Models\SubBusiness;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[
        \Spatie\Permission\PermissionRegistrar::class
        ]->forgetCachedPermissions();

//        $arrayOfPermissionNames = [
//            'access clients',
//            'create employee',
//            'edit profile',
//            'replenish balance',
//            'manipulate bonus',
//            'block user'
//        ];
//        $permissions = collect($arrayOfPermissionNames)->map(function (
//            $permission
//        ) {
//            return ["name" => $permission, "guard_name" => "web"];
//        });
//
//        Permission::insert($permissions->toArray());
//
//        // create role & give it permissions
//        Role::create(["name" => "admin"])->givePermissionTo(['block user']);
//        Role::create(["name" => "business"])->givePermissionTo(['create employee', 'access clients', 'edit profile', 'replenish balance', 'manipulate bonus']);
//        Role::create(["name" => "client"])->givePermissionTo([]);

//        Role::create(["name" => "employee"]);
//        User::find(7)->assignRole('employee');
//        User::find(7)->givePermissionTo(['edit profile']);
//        User::find(1)->assignRole('business');
        User::find(3)->assignRole('business');

    }
}
