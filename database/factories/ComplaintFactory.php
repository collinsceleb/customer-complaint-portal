<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Complaint;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    protected $model = Complaint::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'reviewed' => $this->faker->boolean,
            'customer_id' => Customer::factory(),
            'branch_id' => Branch::factory(),
        ];
    }
}
