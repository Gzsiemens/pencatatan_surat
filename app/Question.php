<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public static function dataJawaban()
    {
        $jawaban = [
            [
                'nilai' => 'A',
                'bobot' => 4
            ],
            [
                'nilai' => 'B',
                'bobot' => 3
            ],
            [
                'nilai' => 'C',
                'bobot' => 2
            ],
            [
                'nilai' => 'D',
                'bobot' => 1
            ],
            [
                'nilai' => 'E',
                'bobot' => 0
            ]
        ];
        return $jawaban;
    }

    public function detail_jawaban()
    {
        return $this->hasMany('App\QuestionAnswer');
    }

    public function dokumen(){
        return $this->hasMany(QuestionDocs::class, 'question_id', 'id');
    }
}
