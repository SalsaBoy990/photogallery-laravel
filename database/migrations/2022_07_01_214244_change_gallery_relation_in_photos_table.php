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
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign(['gallery_id']);
            $table->unsignedBigInteger('gallery_id')->nullable()->change();
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign(['gallery_id']);
            $table->unsignedBigInteger('gallery_id')->nullable(false)->change();
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete(null)->change();
        });
    }
};
