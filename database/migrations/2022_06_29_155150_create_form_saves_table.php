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
        Schema::create('form_saves', function (Blueprint $table) {
            $table->id();
            $table->json('formJson')->nullable(); 
            
            //$table->String('name')->nullable();

             $table->string('name');
             $table->string('visibility');
             $table->integer('id_fiche');
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
        Schema::dropIfExists('form_saves');
    }
};
