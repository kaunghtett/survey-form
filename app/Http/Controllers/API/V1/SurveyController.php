<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurvey;
use App\Http\Resources\SurveyResource;
use App\Mail\SurveySubmit;
use Illuminate\Http\Request;
use App\Services\Survey;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Survey as SurveyModel;

class SurveyController extends ApiController
{
    //
    protected $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function submitForm(StoreSurvey $request) {

        try {
            $survey = $this->survey->storeSurvey($request->all());
            $mailData = [
                'title' => 'Demo Email',
                'url' => 'https://www.youtube.com'
            ];
      
            Mail::to(auth()->user()->email)->send(new SurveySubmit($mailData));
    
            return $this->respondMessage("Suvery Successully Submitted");
           
        } catch(Exception $e) {
            return $this->respondWithError("Something went wrong");
        }
       
    }

    public function getAllSurveys() {
        try {
            return SurveyResource::collection(SurveyModel::all());
        }
        catch(Exception $e) {
            return $this->respondWithError('Invaild Error');
        }
    }

    public function getSurvey($id) {
        try {
            $survey = SurveyModel::find($id);
            return $this->respondDataObject(new SurveyResource($survey));
        }
        catch(ModelNotFoundException $e) {
            return $this->respondNotFound("Survey Not Found");
        }
    }


}
