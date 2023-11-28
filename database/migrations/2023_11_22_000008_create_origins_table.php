<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('origins', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('service_id')->references('id')->on('services')->restrictOnDelete();
            $table->string('name');
            $table->string('base_url')->nullable();
            $table->enum('auth_type',['none','user_password','domain_user_password','bearer_token','other']);
            $table->text('auth_config');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('origins');
    }
};
