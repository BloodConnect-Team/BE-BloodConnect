<?php

namespace App\Http\Controllers;
use App\Models\Requests;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
{
    public function index(){
        $respons = DB::table('requests')->get();
        return response()->json(['data' => $respons]);
    }

    public function filter($goldar){
        $respons = DB::table('requests')->where('requests_goldar', '=', $goldar)->get();
        return response()->json(['data' => $respons]);
    }

    public function detail($id){
        $respons = DB::table('requests')->where('id', '=', $id)->get();
        return response()->json($respons);
    }
}
