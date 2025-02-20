<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttendanceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AttendanceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AttendanceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Attendance::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/attendance');
        CRUD::setEntityNameStrings('attendance', 'attendances');
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
        
        // Get all students from user's courses
        $userStudents = \App\Models\Student::whereIn('course_id', $userCourses)->pluck('id');
        
        // Filter attendances to only show those from user's students
        $this->crud->addClause('whereIn', 'student_id', $userStudents);

        $this->crud->addFilter([
            'name'  => 'student_id',
            'type'  => 'select2',
            'label' => 'Student',
        ], function() use ($userStudents) {
            return \App\Models\Student::whereIn('id', $userStudents)->pluck('name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'student_id', $value);
        });

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

        $this->crud->addFilter([
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Status'
          ], [
            'pending' => 'Pending',
            'absent' => 'Absent',
            'present' => 'Present', 
          ], 
        );

        
        CRUD::column('student_id');
        CRUD::column('classe_id');
        CRUD::addColumn([

            'name'  => 'status',
            'label' => 'URL', // Table column heading
            'type'  => 'model_function_attribute',
            'function_name' => 'getStatusLink', // the method in your Model
            // 'function_parameters' => [$one, $two], // pass one/more parameters to that method
            'attribute' => 'route',
            // 'limit' => 100, // Limit the number of characters shown
        ]);
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
        CRUD::setValidation(AttendanceRequest::class);

        CRUD::field('student_id');
        CRUD::field('classe_id');
        CRUD::addField([
            'name' => 'status', 
            'type' => 'select_from_array', 
            'options' => ['pending' => 'Pending', 'present' => 'Present', 'absent' => 'Absent'],
            'allows_null' => false,
            'default' => 'pending',
        ]); 
        //CRUD::column('created_at');

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
        CRUD::column('created_at');
    }
}
