<?php

namespace Tests\Feature;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BankUserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanShareBank()
    {

        [$user1, $user2] = User::factory(2)->create();

        $bank = Bank::factory()->createOne(['user_id' => $user1->id]);

        $this->actingAs($user1)->post(route('bank-user.store'), [
            'bank_id' => $bank->id,
            'user_id' => $user2->id,
        ]);

        $this->assertDatabaseCount('banks_users', 1);
    }
}
