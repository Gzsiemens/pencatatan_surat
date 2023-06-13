<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionDocs extends Model
{
    protected $table = "question_docs";

    protected $primaryKey = "id";

    protected $fillable = [
        'doc_name', 'doc_info', 'doc_file', 'question_id'
    ];

    public function pertanyaan(){
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
