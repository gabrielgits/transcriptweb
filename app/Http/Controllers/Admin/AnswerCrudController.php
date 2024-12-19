<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AnswerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AnswerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AnswerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Answer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/answer');
        CRUD::setEntityNameStrings('answer', 'answers');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // filter by exam from exam_id from table questions
        $this->crud->addFilter([
            'name'  => 'exam_id',
            'type'  => 'select2',
            'label' => 'Exam',
          ], function() {
              return   \App\Models\Exam::all()->pluck('name', 'id')->toArray();
          }, function($value) {
                $questions = \App\Models\Question::where('exam_id', $value)->get();
                $this->crud->addClause('whereIn', 'classe_id', $questions->pluck('id')->toArray());
        });
        $this->crud->addFilter([
            'name'  => 'question_id',
            'type'  => 'select2',
            'label' => 'Question',
          ], function() {
              return   \App\Models\Question::all()->pluck('question', 'id')->toArray();
          }, function($value) {
                $this->crud->addClause('where', 'question_id', $value);
          }
        );
        CRUD::column('id');
        CRUD::column('line');
        CRUD::column('answer');
        CRUD::column('question_id');

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
        CRUD::setValidation(AnswerRequest::class);



        
        CRUD::addField([
            'name' => 'question_id',
            'type' => 'select',
            'model' => 'App\Models\Question',
            'attribute' => 'question',
            'options'   => (function ($query) {
                return $query->orderBy('id', 'desc')->get();
            }),
            'allows_null' => false,
        ]);
        CRUD::field('line');
        CRUD::field('answer');
       


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
