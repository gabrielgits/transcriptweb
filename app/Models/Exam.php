<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'exams';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function sendExam($crud = false)
    {
        return '<a class="btn btn-sm btn-link" href="exam/send/'.urlencode($this->id).'" data-toggle="tooltip" title="Send exam to students"><i class="la la-send"></i> Send Exam</a>';
    }
    public function sendClose($crud = false)
    {
        return '<a class="btn btn-sm btn-link" href="exam/sendclose/'.urlencode($this->id).'" data-toggle="tooltip" title="Close this exam"><i class="la la-close"></i> Close</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function classe(){
        return $this->belongsTo('App\Models\Classe','classe_id');
    }

    public function questions(){
        return $this->hasMany('App\Models\Question','exam_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
