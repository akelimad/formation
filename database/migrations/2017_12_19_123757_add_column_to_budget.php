<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->string('budget');
            $table->double('prevu');
            $table->double('realise');
            $table->double('ajustement');
            $table->double('solde');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropColumn('budget');
            $table->dropColumn('prevu');
            $table->dropColumn('realise');
            $table->dropColumn('ajustement');
            $table->dropColumn('solde');
        });
    }
}
