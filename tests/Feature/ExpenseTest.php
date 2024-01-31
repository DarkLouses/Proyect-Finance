<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Bank;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

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

        $this->actingAs($user)->post(route('expenses.store'), $expense->getAttributes());
        $this->assertDatabaseCount('expenses', 1);
    }

    public function testUpdateExpenseOfBankInUser()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $bank = Bank::factory()->create([
            'user_id' => $user->id
        ]);

        $expense = Expense::factory()->createOne([
            'bank_id' => $bank->id
        ]);

        $response = $this->actingAs($user)->put(route('expenses.update', $expense->id), $expense->getAttributes());
        $response->assertStatus(200);
    }

    public function testDeleteExpenseOfBankInUser()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $bank = Bank::factory()->create([
            'user_id' => $user->id
        ]);

        $expense = Expense::factory()->createOne([
            'bank_id' => $bank->id
        ]);

        $response = $this->actingAs($user)->delete(route('expenses.destroy', $expense->id), $expense->getAttributes());
        $response->assertStatus(200);
    }
    public function testNotStoreAmountInNegative()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $bank = Bank::factory()->create(['user_id' => $user->id]);

        $expense = Expense::factory()->makeOne([
            'bank_id' => $bank->id,
            'amount' => rand(-1000, -1)
        ]);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('El monto no puede ser negativo');

        $this->actingAs($user)->post(route('expenses.store'), $expense->getAttributes());
        $this->assertDatabaseCount('expenses', 0);
    }
}
