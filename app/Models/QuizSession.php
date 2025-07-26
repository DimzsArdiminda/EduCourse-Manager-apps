<?php
// app/Models/QuizSession.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tingkatan',
        'soals',
        'jenis_materi',
        'total_soal',
        'benar',
        'salah',
        'skor',
        'status',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'soals' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'skor' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function calculateScore()
    {
        $this->skor = $this->total_soal > 0 ? ($this->benar / $this->total_soal) * 100 : 0;
        $this->save();
    }
}
