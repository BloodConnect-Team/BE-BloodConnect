<?php

namespace App\Http\Controllers;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
                'message' => 'Fetch all',
                'data' => RequestsResource::collection($respons)

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
                'message' => 'Fetch all',
                'data' => RequestsResource::collection($respons)

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
                'message' => 'Fetch all',
                'data' => DetailRequestsResource::collection($respons)->first()

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

    public function add(Request $request)
    {    
        $validator = Validator::make($request->all(), [
            'rs' => 'required',
            'user' => 'required',
            'nama_pasien' => 'required',
            'pasien_goldar' => 'required',
            'pasien_goldar' => 'required',
            'jenis_donor' => 'required',
            'jumlah_kantong' => 'required',
            'kontak_peson' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $requests = new Requests;
        $requests->rs_id  = $request->rs;
        $requests->user_id  = $request->user;
        $requests->requests_pasien  = $request->nama_pasien;
        $requests->requests_goldar  = $request->pasien_goldar;
        $requests->requests_jenis  = $request->jenis_donor;
        $requests->requests_jumlah  = $request->jumlah_kantong;
        $requests->requests_hp  = $request->kontak_peson;
        $requests->requests_catatan  = $request->catatan;
        $respons = $requests->save();

        return response()->json([
            'response' => Response::HTTP_OK,
            'success' => true,
            'message' => 'Requests created successfully.',
            'data' => $respons,
        ], Response::HTTP_OK);
    }

    
}
