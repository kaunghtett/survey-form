<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurvey;
use App\Mail\SurveySubmit;
use Illuminate\Http\Request;
use App\Services\Survey;
use Exception;
use Illuminate\Support\Facades\Mail;
class SurveyController extends ApiController
{
    //
    protected $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function submitForm(StoreSurvey $request) {

        $survey = $this->survey->storeSurvey($request->all());

        $mailData = [
            'title' => 'Demo Email',
            'url' => 'https://www.youtube.com'
        ];
  
      

        Mail::to(auth()->user()->email)->send(new SurveySubmit($mailData));

        return $this->respondSuccess("Suvery Successully Submitted");
       
    }


}
