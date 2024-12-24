<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StudentsAnswerResource;
use App\Models\StudentsAnswer;
use App\Http\Resources\TestResource;
use App\Models\Test;
use Illuminate\Support\Facades\Validator;

class StudentsAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return StudentsAnswerResource::collection(StudentsAnswer::where('student_id', $id)->get());
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
        //
        $validator = Validator::make($request->all(), [
            'studentId' => 'required', // id of student
            'selectedAnswers' => 'required', // map of answers <int:question_id> => <int:answer_id>
            'testeId' => 'required', // id of test
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null,
            ]);
        }

        $teste = Test::find($request->input('testeId'));
        if (($teste->status != 'ongoing') && ($teste->status != 'pending')) {
            return response()->json([
                'status' => false,
                'message' => 'The test is not available',
                'data' => null,
            ]);
        }

        $correctAnswers = 0;

        foreach ($request->input('selectedAnswers') as $questionId => $answerId) {
            $question = $teste->exam->questions->where('id', $questionId)->first();
            if ($question->answer_id == $answerId) {
                $correctAnswers++;
            }
        }

        $score = ($correctAnswers / $teste->exam->questions->count()) * 20;

        // save all answers
        foreach ($request->input('answers') as $questionId => $answerId) {
            $studentAnswer = new StudentsAnswer;
            $studentAnswer->student_id = $request->input('studentId');
            $studentAnswer->question_id = $questionId;
            $studentAnswer->answer_id = $answerId;
            $studentAnswer->test_id = $request->input('testeId');
            $studentAnswer->save();
        }

        $teste->status = 'finished';
        $teste->score = $score;
        
        $teste->save();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => new TestResource($teste),
        ]);;
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
        return StudentsAnswerResource::collection(StudentsAnswer::where('student_id', $id)->get());
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
        $studentA = StudentsAnswer::find($id);
        $studentA->update($request->all());
        return new StudentsAnswerResource($studentA);
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
        return StudentsAnswer::destroy($id);
    }
}
