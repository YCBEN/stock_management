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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();


            $table->string('titre');
            $table->string('image_path');
            
            $table->integer('prix_achat');
            $table->integer('prix_vente');
            $table->integer('quantite');
            

            $table->foreignId('user_id')   
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
