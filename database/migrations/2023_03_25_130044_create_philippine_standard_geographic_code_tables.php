<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhilippineStandardGeographicCodeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('regionName');
            $table->string('islandGroupCode');
            $table->string('psgc10DigitCode');
            $table->timestamps();
        });

        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('regionCode');
            $table->string('islandGroupCode');
            $table->string('psgc10DigitCode');
            $table->timestamps();
        });

        // city/municipality
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('oldName');
            $table->boolean('isCapital');
            $table->string('provinceCode');
            $table->string('districtCode')->nullable();
            $table->string('regionCode');
            $table->string('islandGroupCode');
            $table->string('psgc10DigitCode');
            $table->timestamps();
        });

        // Schema::create('cities', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('code');
        //     $table->string('name');
        //     $table->string('oldName');
        //     $table->boolean('isCapital');
        //     $table->string('provinceCode');
        //     $table->string('districtCode')->nullable();
        //     $table->string('regionCode');
        //     $table->string('islandGroupCode');
        //     $table->string('psgc10DigitCode');
        //     $table->timestamps();
        // });

        // Schema::create('municipalities', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('code');
        //     $table->string('name');
        //     $table->string('oldName');
        //     $table->boolean('isCapital');
        //     $table->string('provinceCode');
        //     $table->string('districtCode')->nullable();
        //     $table->string('regionCode');
        //     $table->string('islandGroupCode');
        //     $table->string('psgc10DigitCode');
        //     $table->timestamps();
        // });

        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('oldName');
            $table->string('subMunicipalityCode');
            $table->string('cityCode');
            $table->string('municipalityCode');
            $table->string('districtCode')->nullable();
            $table->string('provinceCode');
            $table->string('regionCode');
            $table->string('islandGroupCode');
            $table->string('psgc10DigitCode');
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
        Schema::dropIfExists('regions');
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('municipalities');
        Schema::dropIfExists('barangays');
    }
}
