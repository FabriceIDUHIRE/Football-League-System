<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->string('injury')->nullable()->after('minute'); // Stores injury type
            $table->enum('card', ['yellow', 'red'])->nullable()->after('injury'); // Stores card type
        });
    }

    public function down(): void
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->dropColumn(['injury', 'card']);
        });
    }
};

