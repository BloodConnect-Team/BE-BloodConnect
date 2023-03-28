<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BdrsResource;
use Illuminate\Database\QueryException;

class BdrsController extends Controller
{
    public function get(){
        try {
            $respons = DB::table('bdrs')
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Fetch all',
                'data' => BdrsResource::collection($respons)

            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([

                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []

            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
