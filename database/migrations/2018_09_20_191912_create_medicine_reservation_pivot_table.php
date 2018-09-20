<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineReservationPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_reservation', function (Blueprint $table) {
            $table->integer('medicine_id')->unsigned()->index();
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->integer('reservation_id')->unsigned()->index();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->primary(['medicine_id', 'reservation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicine_reservation');
    }
}
