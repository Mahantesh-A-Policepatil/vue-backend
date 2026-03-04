<?php

namespace Tests\Feature;

use App\Models\CrmUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrmUserIndexQueryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_search_users_from_server_side(): void
    {
        CrmUser::factory()->create(['first_name' => 'Alice', 'department' => 'IT']);
        CrmUser::factory()->create(['first_name' => 'Bob', 'department' => 'HR']);

        $response = $this->getJson('/api/users?search=alice');

        $response->assertOk();
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['first_name' => 'Alice']);
    }

    public function test_it_can_filter_users_from_server_side(): void
    {
        CrmUser::factory()->create(['first_name' => 'Asha', 'city' => 'Mumbai']);
        CrmUser::factory()->create(['first_name' => 'Ravi', 'city' => 'Pune']);

        $response = $this->getJson('/api/users?filter_type=city&filter_value=Mumbai');

        $response->assertOk();
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['first_name' => 'Asha']);
    }

    public function test_it_can_sort_users_from_server_side(): void
    {
        CrmUser::factory()->create(['first_name' => 'A', 'age' => 25]);
        CrmUser::factory()->create(['first_name' => 'B', 'age' => 40]);
        CrmUser::factory()->create(['first_name' => 'C', 'age' => 30]);

        $response = $this->getJson('/api/users?sort_by=age&sort_order=desc');

        $response->assertOk();

        $ages = array_column($response->json(), 'age');

        $this->assertSame([40, 30, 25], $ages);
    }
}
