<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Complaint;
use App\Models\Customer;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $adminRole = Role::create(['name' => 'admin']);
        $customerRole = Role::create(['name' => 'customer']);
        $managerRole = Role::create(['name' => 'manager']);
        // Create an admin user
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($adminRole);

        // Create 3 branches
        $branches = Branch::factory()->count(3)->create();

        // Create 3 managers and assign the manager role
        Manager::factory()->count(3)->create()->each(function ($manager, $index) use ($branches) {
            $manager->user->assignRole('manager');
            $manager->branch_id = $branches[$index]->id;
            $manager->save();
        });

        // Create 26 customers and assign the customer role
        Customer::factory()->count(26)->create()->each(function ($customer) use ($branches) {
            $customer->user->assignRole('customer');
            $customer->branch_id = $branches->random()->id;
            $customer->save();
        });

        // Create complaints, some reviewed and some pending
        Customer::all()->each(function ($customer) {
            Complaint::factory()->count(2)->create([
                'customer_id' => $customer->id,
                'branch_id' => $customer->branch_id,
            ]);
        });
    }
}
