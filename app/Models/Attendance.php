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
    public function getStatusLink()
    {
        $color = 'black'; // default color
        switch ($this->status) {
            case 'present':
                $color = 'text-success';
                break;
            case 'absent':
                $color = 'text-danger';
                break;
            case 'pending':
                $color = 'text-warning';
                break;
        }
        //$url = route('attendance.changeStatus', ['id' => $this->id, 'status' => $this->status]);
        //return '<a href="'.$url.'">texte</a>';
        return '<span class="'.$color.'">'.$this->status.'</span>';
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
