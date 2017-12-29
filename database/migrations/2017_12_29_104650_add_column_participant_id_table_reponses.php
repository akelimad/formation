<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnParticipantIdTableReponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Reponses', function (Blueprint $table) {
            $table->integer('participant_id')->unsigned()->after('reponse');
            $table->foreign('participant_id')->references('id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Reponses', function (Blueprint $table) {
            $table->dropColumn('participant_id');
        });
    }
}
