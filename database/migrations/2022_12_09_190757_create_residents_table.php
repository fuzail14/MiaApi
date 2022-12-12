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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('residentid');
            $table->foreign('residentid')->references('id')->on('users')->onDelete('cascade');
           
            $table->unsignedBigInteger('subadminid');
            $table->foreign('subadminid')->references('id')->on('users')->onDelete('cascade');
           
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->unsignedBigInteger('societyid');
            $table->foreign('societyid')->references('id')->on('societies')->onDelete('cascade');
            $table->unsignedBigInteger('phaseid');
            $table->foreign('phaseid')->references('id')->on('phases')->onDelete('cascade');
            $table->unsignedBigInteger('blockid');
            $table->foreign('blockid')->references('id')->on('blocks')->onDelete('cascade');
            $table->unsignedBigInteger('streetid');
            $table->foreign('streetid')->references('id')->on('streets')->onDelete('cascade');
            $table->unsignedBigInteger('houseid');
            $table->foreign('houseid')->references('id')->on('houses')->onDelete('cascade');
            $table->string('houseaddress');
            $table->string('vechileno');
            $table->string('residenttype');
            $table->string('propertytype');
            $table->integer('committeemember');
            $table->integer('status');
            
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
        Schema::dropIfExists('residents');
    }
};