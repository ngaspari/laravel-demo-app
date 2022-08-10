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
        Schema::table('new_contacts', function (Blueprint $table) {
            $table->index('firstName');
            $table->index('lastName');
            $table->index('address');
            $table->index('country');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_contacts', function (Blueprint $table) {
            $table->dropIndex(['firstName', 'lastName', 'address', 'country', 'email']);
        });
    }
};
