<?php

namespace App\Http\Controllers;
use App\Models\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Resources\RequestsResource;
use App\Http\Resources\DetailRequestsResource;

class RequestsController extends Controller
{
    public function index(){
        try {
            $respons = DB::table('requests')
            ->join('rs', 'requests.rs_id', '=', 'rs.id_rs')
            ->join('users', 'requests.user_id', '=', 'users.id_users')
            ->orderBy('requests.id_requests', 'asc')
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
            ->join('rs', 'requests.rs_id', '=', 'rs.id_rs')
            ->join('users', 'requests.user_id', '=', 'users.id_users')
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
        try {
            $respons = DB::table('requests')
            ->join('rs', 'requests.rs_id', '=', 'rs.id_rs')
            ->join('users', 'requests.user_id', '=', 'users.id_users')
            ->where('requests.id_requests', '=', $id)
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'msg' => 'Fetch all',
                'data' => DetailRequestsResource::collection($respons)->first()

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
    
}
