<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentsAnswerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentsAnswerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentsAnswerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\StudentsAnswer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/students-answer');
        CRUD::setEntityNameStrings('students answer', 'students answers');
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


        CRUD::column('id');
        CRUD::column('student_id');
        CRUD::column('answer_id');
        CRUD::column('question_id');
        CRUD::column('test_id');
        CRUD::column('created_at');
        CRUD::column('updated_at');

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
        CRUD::setValidation(StudentsAnswerRequest::class);

        CRUD::field('id');
        CRUD::field('student_id');
        CRUD::field('answer_id');
        CRUD::field('question_id');
        CRUD::field('test_id');
        CRUD::field('created_at');
        CRUD::field('updated_at');

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
}
