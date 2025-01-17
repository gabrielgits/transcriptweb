<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function student($state, $id)
    {
        /*
            required int id,
    required DateTime date,
    required String title,
    required String text,
    required String state,
    required String type,
    */
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => [
                [
                    'id' => 1,
                    'date' => date('Y-m-d H:i:s'),
                    'title' => 'Teste'.$id,
                    'text' => 'Teste',
                    'state' => 'new',
                    'type' => 'test',
                ],
                [
                    'id' => 2,
                    'date' => date('Y-m-d H:i:s'),
                    'title' => 'Teste'.$id,
                    'text' => 'Teste',
                    'state' => 'new',
                    'type' => 'test',
                ],
                [
                    'id' => 3,
                    'date' => date('Y-m-d H:i:s'),
                    'title' => 'Teste'.$id,
                    'text' => 'Teste',
                    'state' => 'new',
                    'type' => 'test',
                ],
            ],
        ]);
    }

}