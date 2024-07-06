<?php

namespace Tests\Unit;

use App\Models\Branch;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    /** @test */
    public function it_can_create_a_manager()
    {
        $user = User::factory()->create();
        $manager = Manager::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(Manager::class, $manager);
        $this->assertEquals($manager->user->id, $user->id);
    }

    /** @test */
    public function a_manager_belongs_to_a_branch()
    {
        $manager = Manager::factory()->create();
        $branch = Branch::factory()->create([
            'manager_id' => $manager->id,
        ]);

        $this->assertInstanceOf(Branch::class, $manager->branch);
        $this->assertEquals($manager->branch->id, $branch->id);
    }
}
