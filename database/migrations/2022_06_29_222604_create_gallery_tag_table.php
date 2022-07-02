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
        Schema::create('gallery_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('gallery_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->timestamps();

            $table->primary(['gallery_id', 'tag_id']);
            $table->foreign('gallery_id')
                ->references('id')->on('galleries')
                ->cascadeOnDelete();

            $table->foreign('tag_id')
                ->references('id')->on('tags')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_tag');
    }
};
