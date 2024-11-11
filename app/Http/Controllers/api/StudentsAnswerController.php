<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StudentsAnswerResource;
use App\Models\StudentsAnswer;

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
            'student_id' => 'required',
            'answer_id' => 'required',
            'test_id' => 'required',
            'question_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null,
            ]);
        }

        $newStudentA = new StudentsAnswer;
        $newStudentA->student_id = $request->input('student_id');
        $newStudentA->answer_id = $request->input('answer_id');
        $newStudentA->test_id = $request->input('test_id');
        $newStudentA->question_id = $request->input('question_id');


        if($newStudentA->save())
        {
            return new StudentsAnswerResource(StudentsAnswer::find($newStudentA->id));
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',
            'data' => null,
        ]);
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
