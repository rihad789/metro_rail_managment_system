<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);

            $table->string('contact_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('altphone')->nullable();
            $table->string('gender')->nullable();
            $table->string('civilstatus')->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('street')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('pres_division')->nullable();
            $table->string('pres_district')->nullable();
            $table->string('pres_thana')->nullable();
            $table->string('pres_street')->nullable();
            $table->string('pres_postal_code')->nullable();

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
}
