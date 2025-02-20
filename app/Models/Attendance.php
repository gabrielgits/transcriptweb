<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'attendances';
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
    public function getStatusLink() {
        $color = 'black'; // default color
        switch ($this->status) {
            case 'present':
                $color = 'green';
                break;
            case 'absent':
                $color = 'red';
                break;
            case 'pending':
                $color = 'blue';
                break;
        }
        $url ='googlw.com'; //route('attendance.changeStatus', ['id' => $this->id, 'status' => $this->status]);
        return '<a href="'.url($this->status).'" target="_blank">'.$this->status.'</a>';
        //return '<a href="' . $url . '" style="color:' . $color . '">' . $this->status . '</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function student(){
        return $this->belongsTo('App\Models\Student','student_id');
    }
    public function classe(){
        return $this->belongsTo('App\Models\Classe','classe_id');
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
