<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTacticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tactics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('shortname');
            $table->text('description');
            $table->string('mitre_id');
            $table->string('external_id');
            $table->timestamp('modified')->nullable();
            $table->timestamp('created')->nullable();
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
        Schema::dropIfExists('tactics');
    }
}
