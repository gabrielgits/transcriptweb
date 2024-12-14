<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClasseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClasseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClasseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Classe::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/classe');
        CRUD::setEntityNameStrings('classe', 'classes');

        
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addButtonFromModelFunction('line', 'send_point', 'sendPoint', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'send_absence', 'sendAbsence', 'end');
        $this->crud->addButtonFromModelFunction('line', 'send_presence', 'sendPresence', 'end');


        CRUD::column('summary');
        CRUD::column('course_id');

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ClasseRequest::class);


        CRUD::field('summary');
        CRUD::field('course_id');


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function sendAbsence($id)
    {
        $classe = \App\Models\Classe::find($id);
        $students = \App\Models\Student::where([
            ['status', '=', 'active'],
            ['course_id', '=', $classe->course_id],
        ])->get();
        foreach ($students as $student) {
            $attendance = new \App\Models\Attendance;
            $attendance->classe_id = $classe->id;
            $attendance->student_id = $student->id;
            $attendance->status = 'absence';
            $attendance->save();
        }
        \Alert::add('success', 'The absence: ' . $classe->summary . ' has been sent to all students successfully')->flash();
        return redirect()->back();
    }

    public function sendPresence($id)
    {
        $classe = \App\Models\Classe::find($id);
        $students = \App\Models\Student::where([
            ['status', '=', 'active'],
            ['course_id', '=', $classe->course_id],
        ])->get();
        foreach ($students as $student) {
            $attendance = new \App\Models\Attendance;
            $attendance->classe_id = $classe->id;
            $attendance->student_id = $student->id;
            $attendance->status = 'presence';
            $attendance->save();
        }
        \Alert::add('success', 'The presence: ' . $classe->summary . ' has been sent to all students successfully')->flash();
        return redirect()->back();
    }

    public function sendPoint($id)
    {
        $classe = \App\Models\Classe::find($id);
        $students = \App\Models\Student::where([
            ['status', '=', 'active'],
            ['course_id', '=', $classe->course_id],
        ])->get();
        foreach ($students as $student) {
            $dailypoint = new \App\Models\Dailypoint;
            $dailypoint->classe_id = $classe->id;
            $dailypoint->student_id = $student->id;
            $dailypoint->point = 3;
            $dailypoint->save();
        }
        \Alert::add('success', 'The point: ' . $classe->summary . ' has been sent to all students successfully')->flash();
        return redirect()->back();

    }
}
