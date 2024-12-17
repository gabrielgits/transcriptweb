<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('student', 'students');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        
        $this->crud->addFilter([
            'name'  => 'course_id',
            'type'  => 'select2',
            'label' => 'Course',
        ], function() {
            return   \App\Models\Course::all()->pluck('name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'course_id', $value);
        });

        $this->crud->addFilter([
            'name'  => 'status',
            'type'  => 'select2',
            'label' => 'Status',
        ], [
            'pending' => 'Pending',
            'active' => 'Active',
            'blocked' => 'Blocked',
        ]);

        CRUD::column('name');
       
        CRUD::column('phone');
        CRUD::column('status');
        CRUD::column('course_id');


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
        CRUD::column('photo');
        CRUD::column('created_at');
       
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StudentRequest::class);

        CRUD::field('name');
        
        CRUD::field('phone');
        CRUD::addField([
            'name' => 'status',
            'type' => 'select_from_array',
            'options' => [
                'pending' => 'Pending',
                'active' => 'Active',
                'blocked' => 'Blocked',
            ],
            'allows_null' => false,
            'default' => 'pending',
        ]);
        CRUD::addField([
            'name' => 'password',
            'type' => 'password',
            'label' => 'Password'
        ]);
        CRUD::field('course_id');
        CRUD::addField([   // Hidden
            'name'  => 'photo',
            'type'  => 'hidden',
            'value' => 'default.png',
        ],);



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
        CRUD::setValidation(StudentRequest::class);

        CRUD::field('name');
        
        CRUD::field('phone');
        CRUD::addField([
            'name' => 'status',
            'type' => 'select_from_array',
            'options' => [
                'pending' => 'Pending',
                'active' => 'Active',
                'blocked' => 'Blocked',
            ],
            'allows_null' => false,
            'default' => 'pending',
        ]);
        CRUD::addField([
            'name' => 'password',
            'type' => 'hidden',
        ]);
        CRUD::field('course_id');
        CRUD::field('created_at');


    }
}
