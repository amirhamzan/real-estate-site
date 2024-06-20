<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    private $properties = [
        'properties' => [
            'properties-index',
            'properties-create',
            'properties-store',
            'properties-show',
            'properties-edit',
            'properties-update',
            'properties-destroy',
        ],
    ];


    private $transactions = [
        'transactions' => [
            'transactions-index',
            'transactions-create',
            'transactions-store',
            'transactions-show',
            'transactions-edit',
            'transactions-update',
            'transactions-destroy',
        ],

    ];

    private $transaction_users = [
        'transaction-users' => [
            'transaction-users-index',
            'transaction-users-create',
            'transaction-users-store',
            'transaction-users-show',
            'transaction-users-edit',
            'transaction-users-update',
            'transaction-users-destroy',
        ],

    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('role_has_permissions')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('model_has_roles')->delete();

        $seeds = [
            $this->properties,
            $this->transactions,
            $this->transaction_users,
        ];

        foreach ($seeds as $categoryArr) {
            foreach ($categoryArr as $arr) {
                foreach ($arr as $value) {
                    $input = [
                        'name' => $value,
                        'guard_name' => 'web',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    Permission::insert($input);
                }
            }
        }

        // create roles and assign existing permissions
        $role_super_admin = Role::create(['name' => 'super-admin']);
        $super_admin = User::where('email', 'superadmin@example.com')->first();
        $super_admin->assignRole($role_super_admin);


        $role_salesperson = Role::create(['name' => 'salesperson']);
        $role_salesperson->syncPermissions([
            'properties-index',
            'properties-show',
            'transactions-index',
            'transactions-show',
            'transaction-users-index',
            'transaction-users-show',
        ]);

        $users = User::where('email', '!=', 'superadmin@example.com')->get();
        foreach ($users as $user) {
            $user->assignRole($role_salesperson);
        }
    }
}
