<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExamRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ExamCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ExamCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Exam::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/exam');
        CRUD::setEntityNameStrings('exam', 'exams');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // add custom buttons to the linear list
        $this->crud->addButtonFromModelFunction('line', 'send_exam', 'sendExam', 'beginning');

        $this->crud->addButtonFromModelFunction('line', 'send_close', 'sendClose', 'end');

        // filters
        $this->crud->addFilter([
            'name'  => 'name',
            'type'  => 'text',
            'label' => 'Name'
          ]);

        $this->crud->addFilter([
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Status'
          ], [
            'pending' => 'Pending',
            'ongoing' => 'Ongoing',
            'done' => 'Done',
            'finished' => 'Finished',
            'missed' => 'Missed',
        ], 
        );

        $this->crud->addFilter([
            'name'  => 'classe_id',
            'type'  => 'select2',
            'label' => 'Classe',
          ], function() {
              return   \App\Models\Classe::all()->pluck('summary', 'id')->toArray();
          }, function($value) {
              $this->crud->addClause('where', 'classe_id', $value);
        });

        // filter by course from course_id from table classes
        $this->crud->addFilter([
            'name'  => 'course_id',
            'type'  => 'select2',
            'label' => 'Course',
          ], function() {
              return   \App\Models\Course::all()->pluck('name', 'id')->toArray();
          }, function($value) {
                $classes = \App\Models\Classe::where('course_id', $value)->get();
                $this->crud->addClause('whereIn', 'classe_id', $classes->pluck('id')->toArray());
              
        });



        // columns
        CRUD::column('name');
        CRUD::column('status');
        CRUD::column('time');
        CRUD::column('classe_id');
        CRUD::column('created_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ExamRequest::class);

        CRUD::field('name');

        CRUD::addField([
            'name' => 'status',
            'type' => 'select_from_array',
            'options' => [
                'pending' => 'Pending',
                'ongoing' => 'Ongoing',
                'done' => 'Done',
            ],
            'allows_null' => false,
            'default' => 'pending',
        ]);
        CRUD::field('time');
        CRUD::field('classe_id');

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
        CRUD::field('created_at');
    }

    public function sendExam($id)
    {
        $exam = \App\Models\Exam::find($id);
        $students = \App\Models\Student::where([
            ['status', '=', 'active'],
            ['course_id', '=', $exam->classe->course_id],
        ])->get();
        foreach ($students as $student) {
            $test = new \App\Models\Test;
            $test->exam_id = $exam->id;
            $test->student_id = $student->id;
            $test->save();
        }
        \Alert::add('success', 'The exam: ' . $exam->name . ' has been sent successfully')->flash();
        return redirect()->back();

    
    }
    public function sendClose($id)
    {
        
        $testes = \App\Models\Test::where('exam_id', $id)->get();
        foreach ($testes as $test) {
            if ($test->status == 'pending') {
                $test->status = 'missed';
            } else {
                $test->status = 'finished';
            }
            $test->save();
        }
        $exam = \App\Models\Exam::find($id);
        $exam->status = 'finished';
        $exam->save();

        \Alert::add('success', 'The exam: ' . $exam->name . ' has been closed successfully')->flash();
        return redirect()->back();

    }
}
