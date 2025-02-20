<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\AttendanceResource;

use App\Models\Attendance;
use App\Models\Classe;

use Illuminate\Support\Facades\Validator;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return AttendanceResource::collection(Attendance::all());
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
            'classe_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null,
            ]);
        }

        $newAttendance = new Attendance;
        $newAttendance->student_id = $request->input('student_id');
        $newAttendance->classe_id = $request->input('classe_id');


        if($newAttendance->save())
        {
            return new AttendanceResource(Attendance::find($newAttendance->id));
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
        return new AttendanceResource(Attendance::find($id));
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
        $attendance = Attendance::find($id);
        $attendance->update($request->all());
        return new AttendanceResource($attendance);
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
        $attendance = Attendance::find($id);
        $attendance->delete();
        return new AttendanceResource($attendance);
    }

    public function student($id){
     
        $attendances = Attendance::where('student_id', $id)->get();
       
        $countAll = $attendances->count();
        $countPresent = $attendances->where('status','present')->count();
        $countAbsent = $countAll - $countPresent;

        $percent = 0;
        if ($countAll > 0) {
            $percent = $countPresent / $countAll * 100;
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => [
                'percent' => $percent,
                'countAll' => $countAll,
                'countPresent' => $countPresent,
                'countAbsent' => $countAbsent,
            ],
        ]);
    }

    public function studentAll($id){

        $attendances = Attendance::where('student_id', $id)->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => AttendanceResource::collection($attendances),
        ]);
    }

    public function changeStatus($id, $status)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->status = $status;
        $attendance->save();

        return redirect()->back()->with('status', 'Attendance status updated successfully!');
    }
}
