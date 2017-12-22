<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnParticippantSession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participant_session', function (Blueprint $table) {
            $table->tinyInteger('prevu')->after('statut')nullable();
            $table->tinyInteger('present')->after('prevu')nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participant_session', function (Blueprint $table) {
            $table->dropColumn('prevu');
            $table->dropColumn('present');
        });
    }
}
