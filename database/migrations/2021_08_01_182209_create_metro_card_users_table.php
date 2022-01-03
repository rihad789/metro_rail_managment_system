<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetroCardUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metro_card_users', function (Blueprint $table) {

            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("gender");
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('nid')->unique();
            $table->string("division");
            $table->string("district");
            $table->string("thana");
            $table->string("street");
            $table->integer('postalcode');
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
        Schema::dropIfExists('metro_card_users');
    }
}
