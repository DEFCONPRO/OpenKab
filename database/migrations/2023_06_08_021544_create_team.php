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
        if (! Schema::hasTable('team')) {
            Schema::create('team', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->json('menu');
                $table->timestamps();
            });
        }
        if (! Schema::hasTable('user_team')) {
            Schema::create('user_team', function (Blueprint $table) {
                $table->integer('id_user');
                $table->integer('id_team');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_team');
        Schema::dropIfExists('team');
        Schema::dropIfExists('user_team');
    }
};
