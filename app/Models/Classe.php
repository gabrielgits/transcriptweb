<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'classes';
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
    public function sendPresence($crud = false)
    {
        return '<a class="btn btn-sm btn-link" href="classe/sendpresence/'.urlencode($this->id).'" data-toggle="tooltip" title="Send presence to students"><i class="la la-check"></i> Presence</a>';
    }

    public function sendAbsence($crud = false)
    {
        return '<a class="btn btn-sm btn-link" href="classe/sendabsence/'.urlencode($this->id).'" data-toggle="tooltip" title="Send absence to students"><i class="la la-close"></i> Absence</a>';
    }

    public function sendPoint($crud = false)
    {
        return '<a class="btn btn-sm btn-link" href="classe/sendpoint/'.urlencode($this->id).'" data-toggle="tooltip" title="Send point to students"><i class="la la-coins"></i> Point</a>';
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function course(){
        return $this->belongsTo('App\Models\Course','course_id');
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
