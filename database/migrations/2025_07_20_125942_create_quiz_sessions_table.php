<?php
// database/migrations/xxxx_xx_xx_create_quiz_sessions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quiz_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('tingkatan');
            $table->json('soals');
            $table->string('jenis_materi');
            $table->integer('total_soal');
            $table->integer('benar')->default(0);
            $table->integer('salah')->default(0);
            $table->decimal('skor', 5, 2)->default(0);
            $table->enum('status', ['ongoing', 'completed'])->default('ongoing');
            $table->timestamp('started_at');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_sessions');
    }
};
