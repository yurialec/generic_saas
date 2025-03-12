<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('tenant');
        Schema::create('tenant', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain');
            $table->bigInteger('plan_id')->unsigned()->index()->nullable();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('tenant');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
