<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('selling_team_id')->constrained('teamss')->onDelete('cascade');
            $table->foreignId('buying_team_id')->nullable()->constrained('teamss')->onDelete('cascade');
            $table->decimal('bid_amount', 10, 2);
            $table->enum('status', ['Pending', 'Accepted', 'Rejected', 'Negotiating'])->default('Pending');
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('bids');
    }
};

