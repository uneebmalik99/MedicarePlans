<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionaire extends Model
{
    use HasFactory;
    protected $table = 'questionare';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
     
}
