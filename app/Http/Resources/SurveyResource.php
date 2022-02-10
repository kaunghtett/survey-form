<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description ?? '-',
            'status' => $this->status,
            'start_date' => $this->start_date ?? '-',
            'end_date' => $this->end_date ?? '-',
            'questions' =>  SurveyQuestion::collection($this->questions)  ?? null
        ];
    }
}
