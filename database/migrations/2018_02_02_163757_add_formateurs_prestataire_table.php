<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormateursPrestataireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formateur_prestataire', function (Blueprint $table) {
            $table->integer('formateur_id')->unsigned();
            $table->foreign('formateur_id')->references('id')->on('formateurs')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('prestataire_id')->unsigned();
            $table->foreign('prestataire_id')->references('id')->on('prestataires')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->primary(['formateur_id', 'prestataire_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('formateur_prestataire');
    }
}
