<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Bank;
use App\Models\Expense;
use App\Models\User;

class ExpenseTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateExpenseOfBankInUser()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $bank = Bank::factory()->create([
            'user_id' => $user->id
        ]);

        $expense = Expense::factory()->makeOne([
            'bank_id' => $bank->id
        ]);

        $this->actingAs($user)->post(route('expenses.store'), array_merge($expense->getAttributes(), ['bank_id' => $bank->id]));
        $this->assertDatabaseCount('expenses', 1);
    }
}
