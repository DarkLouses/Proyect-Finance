<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('debtors', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->default('profiles_debtors/default.png');
            $table->string('name');
            $table->string('description');
            $table->double('amount', 10, 5);
            $table->date('date');
            $table->enum('status', ['pending', 'paid']);
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('debtors');
    }
};
