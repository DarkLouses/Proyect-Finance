<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $testUser = User::factory()->hasBanks(3)->createOne([
            'email' => 'gabriel@gmail.com',
            'password' => '$2y$10$jog3zoakKEcN/aYK77EE6Of8ipa9eJMKfdCe3V3Bm0Ii6EdXjaYIm'
        ]);

        $testUser->banks->each(function ($userBank) {
            $userBank->expenses()->saveMany(Expense::factory(2)->make());
            $userBank->incomes()->saveMany(Income::factory(2)->make());
        });

        User::factory(2)->create()->each(function ($user) {
            $bank = $user->banks()->save(Bank::factory()->make());
            $bank->expenses()->saveMany(Expense::factory(2)->make());
            $bank->incomes()->saveMany(Income::factory(2)->make());
        });
    }
}
