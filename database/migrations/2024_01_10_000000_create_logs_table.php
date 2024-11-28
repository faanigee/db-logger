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
        Schema::connection(config('dblogger.connection'))->create('main-logs', function (Blueprint $table) {
            $table->id();
            $table->string('level')->index();
            $table->string('ref_type')->nullable();
            $table->string('ref_id')->nullable();
            $table->text('message');
            $table->json('context')->nullable();
            $table->json('extra')->nullable();
            $table->string('created_by')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            $table->string('request_method')->nullable();
            $table->string('request_path')->nullable();
            $table->json('request_headers')->nullable();
            $table->json('request_body')->nullable();
            $table->string('response_status')->nullable();
            $table->double('response_time')->nullable();

            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('dblogger.connection'))->dropIfExists('main-logs');
    }
};
