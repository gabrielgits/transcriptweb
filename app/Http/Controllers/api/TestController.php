<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TestResource;
use App\Http\Resources\QuestionResource;
use App\Models\Test;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return TestResource::collection(Test::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
               
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return TestResource::collection(Test::where('student_id', $id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $test = Test::find($id);
        $test->update($request->all());
        return new TestResource($test);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Test::destroy($id);
    }

    public function startTest($testeId)
    {


        $teste = Test::find($testeId);
        if (($teste->status != 'ongoing') && ($teste->status != 'pending')) {
            return response()->json([
                'status' => false,
                'message' => 'The test is not available',
                'data' => null,
            ]);
        }

        if (($teste->exam->status != 'ongoing') && ($teste->exam->status != 'pending')) {
            return response()->json([
                'status' => false,
                'message' => 'The exam is not available',
                'data' => null,
            ]);
        }

        $teste->status = 'ongoing';
        $teste->save();

        $questions = Question::where('exam_id', $teste->exam_id)->get();

        return response()->json([
            'status' => true, 
            'message' => 'Success', 
            'data' => QuestionResource::collection($questions),
        ]);
       
    }

    public function student($id){
      
        $testes = Test::where([
            ['student_id', $id],
            //['exam_id', '<>' , 3],
        ])->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => TestResource::collection($testes),
        ]);
    }

    public function studentLimit($id,$limit){
      
        $testes = Test::where([
            ['student_id', $id],
            ['status', '<>' , 'pending'],
            ['status', '<>' , 'ongoing'],
            //['exam_id', '<>' , 3],
        ])->orderBy('id', 'desc')->get();


        if ($testes->count() < 1) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => null,
            ]);
        }

        $average = $testes->avg('score');
        $testesLimit = $testes->take($limit);
        
        
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => [
                'average' => $average, 
                'testes' => TestResource::collection($testesLimit),
            ],
        ]);
    }
}
