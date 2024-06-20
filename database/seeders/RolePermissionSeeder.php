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
    private $property = [
        'property' => [
            'property-index',
            'property-create',
            'property-store',
            'property-show',
            'property-edit',
            'property-update',
            'property-destroy',
        ],
    ];


    private $transaction = [
        'transaction' => [
            'transaction-index',
            'transaction-create',
            'transaction-store',
            'transaction-show',
            'transaction-edit',
            'transaction-update',
            'transaction-destroy',
        ],

    ];

    private $transaction_user = [
        'transaction-user' => [
            'transaction-user-index',
            'transaction-user-create',
            'transaction-user-store',
            'transaction-user-show',
            'transaction-user-edit',
            'transaction-user-update',
            'transaction-user-destroy',
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
            $this->property,
            $this->transaction,
            $this->transaction_user,
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
            'property-index',
            'property-show',
            'transaction-index',
            'transaction-show',
            'transaction-user-index',
            'transaction-user-show',
        ]);

        $users = User::where('email', '!=', 'superadmin@example.com')->get();
        foreach ($users as $user) {
            $user->assignRole($role_salesperson);
        }
    }
}
