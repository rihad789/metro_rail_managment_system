<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetroCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metro_cards', function (Blueprint $table) {

            $table->id();
            $table->string('card_no');
            $table->string('pin');
            $table->integer('card_user_id');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('metro_cards');
    }
}
