<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Complaint;
use App\Models\Customer;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@seal.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create 3 branches
        $branches = Branch::factory(3)->create();

        // Create 3 managers, each assigned to a different branch
        foreach ($branches as $branch) {
            Manager::factory()->create([
                'branch_id' => $branch->id,
            ]);
        }

        // Create 26 customers, distributed among the branches
        foreach ($branches as $branch) {
            Customer::factory(8)->create(['branch_id' => $branch->id]);
        }

        // Additional 2 customers to make the total count 26
        Customer::factory(2)->create(['branch_id' => $branches->first()->id]);

        // Create complaints, some reviewed and some pending
        Customer::all()->each(function ($customer) {
            Complaint::factory(2)->create([
                'customer_id' => $customer->id,
                'branch_id' => $customer->branch_id,
            ]);
        });
    }
}
