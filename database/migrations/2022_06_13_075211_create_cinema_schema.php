<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /**
    # Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different locations

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I don't want to configure the seating for every show
     */
    public function up(): void
    {
        // Users
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();
        });

        // Films and shows
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_a_show')->default(false);
            $table->boolean('is_booked')->default(false);
            $table->decimal('price');
            $table->dateTime('starts_at');
            $table->timestamps();
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->boolean('is_available')->default(true);
            $table->decimal('price');
            $table->decimal('percentage_premium');
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users_films', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('film_id');
            $table->foreignId('seat_id');
            $table->foreignId('location_id');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('films');
        Schema::dropIfExists('seats');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('users_films');
    }
}
