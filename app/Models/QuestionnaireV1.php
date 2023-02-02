<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireV1 extends Model
{
    use HasFactory;
    protected $table = 'questionnaire_v1';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
}
