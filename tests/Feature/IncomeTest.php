<?php

namespace Tests\Feature;

use App\Models\Bank;
use App\Models\Income;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncomeTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateIncomeBankInUser()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $bank = Bank::factory()->create([
            'user_id' => $user->id
        ]);

        $income = Income::factory()->makeOne([
            'bank_id' => $bank->id
        ]);

        $this->actingAs($user)->post(route('income.store'), $income->getAttributes());
        $this->assertDatabaseCount('incomes', 1);
    }

    public function testUpdateIncomeBankInUser()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $bank = Bank::factory()->create([
            'user_id' => $user->id
        ]);

        $income = Income::factory()->createOne([
            'bank_id' => $bank->id
        ]);

        $response = $this->actingAs($user)->put(route('income.update', $income->id), $income->getAttributes());
        $response->assertStatus(200);
    }

    public function testDeleteIncomeBankInUser()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $bank = Bank::factory()->create([
            'user_id' => $user->id
        ]);


        $income = Income::factory()->createOne([
            'bank_id' => $bank->id
        ]);

        $response = $this->actingAs($user)->delete(route('income.destroy', $income->id), $income->getAttributes());
        $response->assertStatus(200);
    }
}
