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
        Schema::create('project_technology', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade'); //metto 'cascade' (per lo più su onDelete perché quando cancello un progetto si devono cancellare anche tutte le associazioni con le technologies)

            $table->unsignedBigInteger('technology_id')->nullable();
            $table->foreign('technology_id')->references('id')->on('technologies')->onUpdate('cascade')->onDelete('cascade'); 

            $table->primary(['project_id', 'technology_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_technology');
    }
};
