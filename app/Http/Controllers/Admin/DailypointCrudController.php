<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DailypointRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DailypointCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DailypointCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Dailypoint::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/dailypoint');
        CRUD::setEntityNameStrings('dailypoint', 'dailypoints');
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
            'name'  => 'student_id',
            'type'  => 'select2',
            'label' => 'Student',
          ], function() {
              return   \App\Models\Student::all()->pluck('name', 'id')->toArray();
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

        CRUD::column('student_id');
        CRUD::column('classe_id');
        CRUD::column('point');
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
        CRUD::setValidation(DailypointRequest::class);

       
        
        CRUD::field('student_id');
        CRUD::field('classe_id');
        CRUD::addField([
            'name' => 'point',
            'type' => 'select_from_array',
            'options' => [
                '1' => 'Very Bad',
                '2' => 'Bad',
                '3' => 'Normal',
                '4' => 'Good',
                '5' => 'Very Good',
            ],
            'allows_null' => false,
            'default' => '1',
        ]);
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
