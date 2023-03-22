<?php

namespace App\Http\Controllers;
use App\Models\Requests;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
{
    public function index(){
        $respons = DB::table('requests')
        ->join('rs', 'requests.rs_id', '=', 'rs.id')
        ->get();
        return response()->json(['data' => $respons]);
    }

    public function filter($goldar){
        $respons = DB::table('requests')
        ->join('rs', 'requests.rs_id', '=', 'rs.id')
        ->where('requests_goldar', '=', $goldar)
        ->get();
        return response()->json(['data' => $respons]);
    }

    public function detail($id){
        $respons = DB::table('requests')
        ->join('rs', 'requests.rs_id', '=', 'rs.id')
        ->where('requests.id', '=', $id)
        ->get();
        return response()->json($respons);
    }
    
}
