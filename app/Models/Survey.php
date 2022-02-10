<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = "surveys";

    protected $fillable = [
        'title',
        'description',
        'status',
        'start_date',
        'end_date'
    ];

    public function questions()
    {
        return $this->hasMany('App\Models\Survey');
    }  
}
