<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_session_id',
        'nomor_soal',
        'pertanyaan',
        'opsi',
        'jawaban_benar',
        'jawaban_siswa',
        'is_correct',
        'answered_at'
    ];

    protected $casts = [
        'opsi' => 'array',
        'is_correct' => 'boolean',
        'answered_at' => 'datetime'
    ];

    public function quizSession()
    {
        return $this->belongsTo(QuizSession::class);
    }
}
