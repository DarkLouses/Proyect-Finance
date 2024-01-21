<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
    public function run()
    {
        User::factory(2)->create()->each(function ($user) {
            $bank = $user->banks()->save(Bank::factory()->make());

            if (!$bank->banksUsers()->where('user_id', $user->id)->exists()) {
                $bank->banksUsers()->attach($user->id);

                // Verificar y adjuntar el banco al usuario (si no está ya adjunto)
                if (!$user->banksUsers()->where('bank_id', $bank->id)->exists()) {
                    $user->banksUsers()->attach($bank->id);
                }
            }

            $user->banks->each(function ($userBank) {
                $userBank->banksUsers()->syncWithoutDetaching([$userBank->id]);
                $userBank->expenses()->saveMany(Expense::factory(2)->make());
                $userBank->incomes()->saveMany(Income::factory(2)->make());
            });
        });
    }
}
