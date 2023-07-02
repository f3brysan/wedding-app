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
        Schema::create('tr_tujuan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama', 255)->nullable();
            $table->string('slug',255)->nullable();
            $table->decimal('telp', 25, 0)->nullable();
            $table->boolean('is_open')->default(false)->nullable();
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
        Schema::dropIfExists('tr_tujuan');
    }
};
