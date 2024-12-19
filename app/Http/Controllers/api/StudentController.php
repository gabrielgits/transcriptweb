<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Student;
use App\Models\Test;
use App\Models\Attendance;
use App\Models\Dailypoint;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return StudentResource::collection(Student::all());
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
            'name' => 'required',
            'phone' => 'required',
            'course' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null,
            ]);
        }

        $newStudent = new Student;
        $newStudent->name = $request->input('name');
        $newStudent->photo = $request->input('photo');
        $newStudent->phone = $request->input('phone');
        $newStudent->status = $request->input('status');
        $newStudent->password = Hash::make($request->Password);
        $newStudent->course_id = $request->input('course_id');


        if($newStudent->save())
        {
            return new StudentResource(Student::find($newStudent->id));
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
        return new StudentResource(Student::find($id));
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
        $student = Student::find($id);
        $student->update($request->all());
        return new StudentResource($student);
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
        return Student::destroy($id);
    }

    public function finalScore($id){
      
        $finalAverage = 0;
        
        // get testes average
        $testes = Test::where([
            ['student_id', $id],
            ['status', '<>' , 'pending'],
            ['status', '<>' , 'ongoing'],
        ])->orderBy('id', 'desc')->get();
        
        $testesAverage = $testes->avg('score');
        
        // get attendances count and percent
        $attendances = Attendance::where('student_id', $id)->get();
       
        $attendancesCountAll = $attendances->count();
        $attendancesCountPresent = $attendances->where('status','present')->count();

        $attendancesPercent = 0;
        if ($attendancesCountAll > 0) {
            $attendancesPercent = $attendancesCountPresent / $attendancesCountAll * 100;
        } 

        // get daily point average
        $dailypoints = Dailypoint::where('student_id', $id)->get();
        $dailypointsAverage = $dailypoints->avg('point');

        // calculate final daily point
        $dailypointsAverageFinal = 0;
        if ($attendancesPercent > 50){
            $dailypointsAverageFinal = -2;
        } 
        if ($attendancesPercent >= 70 && $attendancesPercent < 90){
            $dailypointsAverageFinal = $dailypointsAverage * 0.50;
        } else if ($attendancesPercent >= 70 && $attendancesPercent < 90){
            $dailypointsAverageFinal = $dailypointsAverage;
        } else if ($attendancesPercent >= 90){
            $dailypointsAverageFinal = $dailypointsAverage;
        }

        // get finalAverage
        $finalAverage =  $testesAverage + $dailypointsAverageFinal;

        // check all data
        if (is_nan($testesAverage) || $testesAverage == null) {
            $testesAverage = 0;
        }
        if (is_nan($dailypointsAverageFinal) || $dailypointsAverageFinal == null) {
            $dailypointsAverageFinal = 0;
        }
        if (is_nan($finalAverage) || $finalAverage == null) {
            $finalAverage = 0;
        }

        // return results
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => [
                'testesAverage' => $testesAverage,
                'attendancesPercent' => $attendancesPercent,
                'dailypointsAverageFinal' => $dailypointsAverageFinal,
                'finalAverage' => $finalAverage,
            ],
        ]);
    }
}
