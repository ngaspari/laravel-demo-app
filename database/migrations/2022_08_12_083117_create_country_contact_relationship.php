<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public $withinTransaction = true;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('contacts', function (Blueprint $table) {
            $table->bigInteger('country_id', false, true)->nullable(true);
            
            $table->foreign('country_id')
                ->references('id')->on('countries');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign('country_id');
        });

    }
};
