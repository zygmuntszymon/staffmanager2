<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedemptionsTable extends Migration
{
    public function up()
    {
        Schema::create('redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('benefit_type', ['vacation_day', 'cash_bonus']);
            $table->unsignedInteger('points_spent');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('redemptions');
    }
}
