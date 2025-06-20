<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('from_team_id');
            $table->unsignedBigInteger('to_team_id');
            $table->decimal('transfer_fee', 10, 2)->nullable(); // Transfer fee, nullable if no fee
            $table->date('transfer_date');
            $table->string('contract_duration'); // e.g., '2 years', '3 months'
            $table->enum('status', ['completed', 'pending', 'rejected'])->default('completed');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('from_team_id')->references('id')->on('teamss')->onDelete('cascade');
            $table->foreign('to_team_id')->references('id')->on('teamss')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
