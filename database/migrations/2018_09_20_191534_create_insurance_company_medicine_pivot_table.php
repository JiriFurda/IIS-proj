<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceCompanyMedicinePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_company_medicine', function (Blueprint $table) {
            $table->integer('insurance_company_id')->unsigned()->index();
            $table->foreign('insurance_company_id')->references('id')->on('insurance_companies')->onDelete('cascade');
            $table->integer('medicine_id')->unsigned()->index();
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->primary(['insurance_company_id', 'medicine_id'], 'insurance_company_medicine_id'); // Custom name because it was too long for MySQL
        
			$table->unsignedDecimal('amount', 5, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('insurance_company_medicine');
    }
}
