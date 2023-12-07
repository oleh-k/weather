<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('forecast_archives', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('forecast_data', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('forecast_archive_id');
            $table->foreign('forecast_archive_id')
                ->references('id')
                ->on('forecast_archives')
                ->onDelete('cascade');

            $table->date('date');
            $table->float('maxtemp');
            $table->float('mintemp');
            $table->float('avgtemp');
            $table->integer('daily_chance_of_rain');
            $table->integer('daily_chance_of_snow');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
        Schema::dropIfExists('forecast_data');
        Schema::dropIfExists('forecast_archives');
    }
};
