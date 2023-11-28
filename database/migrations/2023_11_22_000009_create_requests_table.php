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
        Schema::create('requests', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->timestamps();
            $table->foreignUuid('origin_id')->references('id')->on('origins');
            $table->string('request_url');
            $table->ipAddress('request_ip');
            $table->mediumText('request_data');
            $table->longText('request_raw_data');
            $table->mediumText('request_detail');
            $table->mediumText('request_query_string');
            $table->mediumText('request_headers');
            $table->mediumText('request_body');
            $table->enum('status',['unauthorized','authorized']);
            $table->enum('request_method',['POST','GET','PUT','PATCH','OPTIONS','DELETE']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
