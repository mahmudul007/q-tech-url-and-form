<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $table = 'submissions';
    protected $fillable = [

        'user_id',
        'form_id',
        'submission_data',

    ];
    public function SubmissionUser()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
    public function form()
    {
        return $this->belongsTo(Form::class , 'form_id' , 'id');
    }
}
