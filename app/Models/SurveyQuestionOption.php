<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestionOption extends Model
{
    use HasFactory;
    protected $table = "survey_question_options";

    protected $fillable = [
        'name',
        'type',
        'question_id'
    ];

}
