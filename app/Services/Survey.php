<?php

namespace App\Services;

use App\Models\Survey as ModelsSurvey;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionOption;
use Symfony\Component\Console\Question\Question;

class Survey {

    public function storeSurvey($data) {

        $survey = ModelsSurvey::create([
            "title" => $data["title"],
            "description" => $data["description"],
            "status" => $data["status"],
            "start_date" => $data["start_date"],
            "end_date" => $data["end_date"]
        ]);

        if(isset($data["questions"]) && $data["questions"] != null) {
            foreach($data["questions"] as $question) {
              
                $survey_question = $this->storeSurveyQuestion($survey,$question);
                if($question["options"]) {

                    $this->storeSuveryQuestionOptions($survey_question,$question);
                }
            }
        }

        return $survey;

    }


    public function storeSurveyQuestion($survey,$question) {
        $survey_question = SurveyQuestion::create([
            "title" => $question["title"],
            "type" => $question["type"],
            "survey_id" => $survey->id,
            "order" => $question["order"]
        ]);

        return $survey_question;
    }


    public function storeSuveryQuestionOptions($survey_question,$question) {
        foreach($question["options"] as $option) {
            SurveyQuestionOption::create([
                "name" => $option["name"],
                "type" => $option["type"],
                "question_id" => $survey_question->id
            ]);
        }

        return true;
    }

}