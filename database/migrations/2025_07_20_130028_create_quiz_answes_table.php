<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_session_id');
            $table->integer('nomor_soal');
            $table->text('pertanyaan');
            $table->json('opsi');
            $table->string('jawaban_benar');
            $table->string('jawaban_siswa')->nullable();
            $table->boolean('is_correct')->default(false);
            $table->timestamp('answered_at')->nullable();
            $table->timestamps();

            $table->foreign('quiz_session_id')->references('id')->on('quiz_sessions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_answers');
    }
};
