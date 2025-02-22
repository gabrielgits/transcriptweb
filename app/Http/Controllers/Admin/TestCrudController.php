<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TestCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Test::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/test');
        CRUD::setEntityNameStrings('test', 'tests');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

            // Get all courses belonging to current user
    $userCourses = \App\Models\Course::where('user_id', backpack_user()->id)->pluck('id');
    
    // Get all studants from user's courses
    $userStudants = \App\Models\Student::whereIn('course_id', $userCourses)->pluck('id');
    
    // Filter tests to only show those from user's studants
    $this->crud->addClause('whereIn', 'student_id', $userStudants);

        $this->crud->addFilter([
            'name'  => 'student_id',
            'type'  => 'select2',
            'label' => 'Student',
        ], function() use ($userStudants) {
            return \App\Models\Student::whereIn('id', $userStudants)->pluck('name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'student_id', $value);
      });

        $this->crud->addFilter([
            'name'  => 'exam_id',
            'type'  => 'select2',
            'label' => 'Exam',
          ], function() {
              return   \App\Models\Exam::all()->pluck('name', 'id')->toArray();
          }, function($value) {
              $this->crud->addClause('where', 'exam_id', $value);
        });

        

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

        CRUD::column('student_id');
        CRUD::column('exam_id');
        CRUD::column('score');    
        CRUD::column('status');   
        CRUD::column('created_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }
    protected function setupShowOperation()
    {
        $this->setupListOperation();
        CRUD::column('points');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TestRequest::class);

        CRUD::addField([
            'name' => 'status',
            'type' => 'select_from_array',
            'options' => [
                'pending' => 'Pending',
                'ongoing' => 'Ongoing',
                'missed' => 'Missed',
                'done' => 'Done',
            ],
            'allows_null' => false,
            'default' => 'pending',
        ]);
        CRUD::field('score');
        CRUD::field('points');
        CRUD::field('exam_id');
        CRUD::field('student_id');

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
}
