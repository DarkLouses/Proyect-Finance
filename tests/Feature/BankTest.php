<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Bank;
use App\Models\User;

class BankTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateBankOfUser()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $bank = Bank::factory()->makeOne([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->post(route('banks.store'), $bank->getAttributes());
        $this->assertDatabaseCount('banks', 1);
    }

    public function testUpdateBankOfUser()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $bank = Bank::factory()->createOne([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->put(route('banks.update', $bank->id), $bank->getAttributes());
        $response->assertStatus(200);
    }

    public function testDeleteBankOfUser()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $bank = Bank::factory()->createOne([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete(route('banks.destroy', $bank->id), $bank->getAttributes());
        $response->assertStatus(200);
    }
}
