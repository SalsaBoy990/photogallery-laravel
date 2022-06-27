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
        Schema::table(
            'goals',
            function (Blueprint $table) {
                $table->string('title')->unique()->change();
                $table->string('image')->nullable()->change();
                $table->boolean('completed')->nullable()->change();
                $table->unsignedInteger('order')->default(0)->change();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'goals',
            function (Blueprint $table) {
                $table->string('title')->unique(false)->change();
                $table->string('image')->nullable(false)->change();
                $table->boolean('completed')->nullable(false)->change();
                $table->unsignedInteger('order')->default(NULL)->change();
            }
        );
    }
};
