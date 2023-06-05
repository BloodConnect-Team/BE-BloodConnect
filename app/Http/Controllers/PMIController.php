<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\StokResource;
use App\Http\Resources\JadwalResource;
use Illuminate\Database\QueryException;

class PMIController extends Controller
{
    public function stok(){
        try {
            $respons = DB::table('stoks')
            ->orderBy('created_at', 'desc')
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Fetch all Stok UDD',
                'data' => StokResource::collection($respons)->first()

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

    public function jadwal(){
        $tgl = date("Y-m-d");
        try {
            $respons = DB::table('jadwals')
            ->where('waktu', ">=", $tgl)
            ->orderBy('waktu', 'ASC')
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Fetch all Jadwal',
                'data' => JadwalResource::collection($respons)

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
