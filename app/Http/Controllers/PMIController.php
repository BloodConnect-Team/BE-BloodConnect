<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\JadwalResource;
use Illuminate\Database\QueryException;

class PMIController extends Controller
{
    public function jadwal(){
        $tgl = date("Y-m-d"." 00:00:00");
        try {
            $respons = DB::connection('mysql2')
            ->table('kegiatan')
            ->join('udd', 'kegiatan.udd', '=', 'udd.id')
            ->orderBy('udd.id')
            ->where('kegiatan.TglPenjadwalan', '=', $tgl)
            ->get();

            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Fetch all Jadwal MU',
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

    public function kontak(){
        try {
            $respons = DB::connection('mysql2')
            ->table('udd')
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Fetch all Jadwal MU',
                'data' => KontakResource::collection($respons)

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
