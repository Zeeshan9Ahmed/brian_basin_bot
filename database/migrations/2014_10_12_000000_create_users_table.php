<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->unique();
            $table->boolean('profile_completed')->default(0);
            $table->enum('role',['user','admin'])->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            $table->string('emergency_number')->nullable();
            $table->boolean('is_allowed_location')->nullable();
            $table->boolean('is_allowed_push_notification')->default(1);
            $table->boolean('is_allowed_light_bird')->default(1);
            $table->boolean('is_allowed_flashy_bird')->default(1);
            $table->boolean('is_allowed_nav_bird')->default(1);
            $table->boolean('is_allowed_loud_bird')->default(1);
            $table->string('device_type')->nullable();
            // $table->boolean('is_social')->nullable();
            $table->string('device_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
