<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourneyFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journey_fares', function (Blueprint $table) {
            $table->id();
            $table->integer("line_id");
            $table->integer("start_station");
            $table->integer("destination_station")->nullable();
            $table->boolean("status")->default(0);
            $table->string("card_no");
            $table->double('distance')->default(0);
            $table->double("charged_fare")->default(0);
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
        Schema::dropIfExists('journey_fares');
    }
}
