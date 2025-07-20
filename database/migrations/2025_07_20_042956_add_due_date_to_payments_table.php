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
        Schema::table('payments', function (Blueprint $table) {
            $table->date('due_date')->nullable()->after('due_amount');
        });
    }
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('due_date');
        });
    }

};
