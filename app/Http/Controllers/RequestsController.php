<?php

namespace App\Http\Controllers;
use App\Models\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Resources\RequestsResource;

class RequestsController extends Controller
{
    public function index(){
        try {
            $respons = DB::table('requests')
            ->join('rs', 'requests.rs_id', '=', 'rs.id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'msg' => 'Fetch all',
                'data' => RequestsResource::collection($respons)

            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([

                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'msg' => $e->getMessage(),
                'data' => []

            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function filter($goldar){
        try {
            $respons = DB::table('requests')
            ->join('rs', 'requests.rs_id', '=', 'rs.id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->where('requests_goldar', '=', $goldar)
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'msg' => 'Fetch all',
                'data' => RequestsResource::collection($respons)

            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([

                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'msg' => $e->getMessage(),
                'data' => []

            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function detail($id){
        $respons = DB::table('requests')
        ->join('rs', 'requests.rs_id', '=', 'rs.id')
        ->join('users', 'requests.user_id', '=', 'users.id')
        ->where('requests.id', '=', $id)
        ->get();
        return response()->json($respons);
    }
    
}
