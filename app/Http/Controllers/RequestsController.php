<?php

namespace App\Http\Controllers;
use App\Models\Requests;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
{
    public function index(){
        $req = DB::table('requests')->get();
        return response()->json(['data' => $req]);
    }

    public function filter($goldar){
        $req = DB::table('requests')->where('requests_goldar', '=', $goldar)->get();
        return response()->json(['data' => $req]);
    }
}
