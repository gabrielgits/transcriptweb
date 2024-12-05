<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\DailypointResource;

use App\Models\Dailypoint;

use Illuminate\Support\Facades\Validator;


class DailypointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DailypointResource::collection(Dailypoint::all());
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
            'point' => 'required',
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

        $newDailypoint = new Dailypoint;
        $newDailypoint->point = $request->input('point');
        $newDailypoint->student_id = $request->input('student_id');
        $newDailypoint->classe_id = $request->input('classe_id');


        if($newDailypoint->save())
        {
            return new DailypointResource(Dailypoint::find($newDailypoint->id));
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
        return new DailypointResource(Dailypoint::find($id));
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
        $dailypoint = Dailypoint::find($id);
        $dailypoint->update($request->all());
        return new DailypointResource($dailypoint);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $dailypoint = Dailypoint::find($id);
        $dailypoint->delete();
        return new DailypointResource($dailypoint);
    }

    public function student($id){

        $dailypoints = Dailypoint::where('student_id', $id)->get();
       
        $countAll = $dailypoints->count();
        $average = $dailypoints->avg('point');
        
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => [
                'average' => $average, 
                'countAll' => $countAll,
            ],
        ]);
    }

    public function studentAll($id){
 
        $dailypoints = Dailypoint::where('student_id', $id)->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => DailypointResource::collection($dailypoints),
        ]);
    }
}
