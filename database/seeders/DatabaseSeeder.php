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
    public function run(): void
    {
        // Crear un usuario de prueba con tres bancos asociados
        $testUser = User::factory()->hasBanks(3)->createOne([
            'email' => 'gabriel@gmail.com',
            'password' => '$2y$10$jog3zoakKEcN/aYK77EE6Of8ipa9eJMKfdCe3V3Bm0Ii6EdXjaYIm'
        ]);

        // Para cada banco asociado al usuario de prueba
        $testUser->banks->each(function ($userBank) {
            // Sincronizar la relación banksUsers y crear gastos e ingresos
            //$userBank->banksUsers()->syncWithoutDetaching([$userBank->id]);
            $userBank->expenses()->saveMany(Expense::factory(2)->make());
            $userBank->incomes()->saveMany(Income::factory(2)->make());
        });

        // Crear dos usuarios adicionales con un banco cada uno
        User::factory(2)->create()->each(function ($user) {
            $bank = $user->banks()->save(Bank::factory()->make());

            // Verificar si el usuario ya está asociado al banco
           /* if (!$bank->banksUsers()->where('user_id', $user->id)->exists()) {
                $bank->banksUsers()->attach($user->id);
            }*/

            // Sincronizar la relación banksUsers y crear gastos e ingresos
           // $bank->banksUsers()->syncWithoutDetaching([$bank->id]);
            $bank->expenses()->saveMany(Expense::factory(2)->make());
            $bank->incomes()->saveMany(Income::factory(2)->make());
        });
    }
}
