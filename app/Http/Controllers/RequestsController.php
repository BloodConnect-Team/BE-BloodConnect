<?php

namespace App\Http\Controllers;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Resources\RequestsResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DetailRequestsResource;

class RequestsController extends Controller
{
    public function index(){
        try {
            $respons = DB::table('requests')
            ->join('bdrs', 'requests.bdrs_id', '=', 'bdrs.id_bdrs')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->where('requests.requests_status', '=', '1')
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

    public function search(Request $request){
        try {
            $keyword = $request->input('keyword');
            $respons = DB::table('requests')
            ->join('bdrs', 'requests.bdrs_id', '=', 'bdrs.id_bdrs')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->where('requests.requests_status', '=', '1')
            ->Where('requests.requests_pasien', 'like', "%$keyword%")
            ->orderBy('requests.id_requests', 'asc')
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Search req : '.$keyword,
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
            ->join('bdrs', 'requests.bdrs_id', '=', 'bdrs.id_bdrs')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->where('requests_goldar', '=', $goldar)
            ->where('requests.requests_status', '=', '1')
            ->orderBy('requests.id_requests', 'asc')
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Fetch filter: '.$goldar,
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
            ->join('bdrs', 'requests.bdrs_id', '=', 'bdrs.id_bdrs')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->where('requests.id_requests', '=', $id)
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Fetch detail id: ' . $id,
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

    public function my(){
        try {
            $respons = DB::table('requests')
            ->join('bdrs', 'requests.bdrs_id', '=', 'bdrs.id_bdrs')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->where('requests.user_id', '=', Auth::user()->id)
            ->get();
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Fetch my all',
                'data' => DetailRequestsResource::collection($respons)

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
            'bdrs' => 'required',
            'nama_pasien' => 'required',
            'pasien_goldar' => 'required',
            'jenis_donor' => 'required',
            'jumlah_kantong' => 'required',
            'kontak_nomor' => 'required',
            'kontak_nama' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([

                'response' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'success' => false,
                'message' => $validator->errors(),
                'data' => []

            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }else{
            $requests = new Requests;

            $arr = explode(' ', $request->nama_pasien);
            $singkatan = '';
            foreach($arr as $kata)
            {
                $singkatan .= substr($kata, 0, 1);
            };

            $requests->bdrs_id  = $request->bdrs;
            $requests->user_id  = Auth::user()->id;
            $requests->requests_slug  = $singkatan.$request->bdrs.$request->jumlah_kantong.rand(1000,9999);
            $requests->requests_pasien  = $request->nama_pasien;
            $requests->requests_goldar  = $request->pasien_goldar;
            $requests->requests_jenis  = $request->jenis_donor;
            $requests->requests_jumlah  = $request->jumlah_kantong;
            $requests->requests_hp  = $request->kontak_nomor;
            $requests->requests_nama  = $request->kontak_nama;
            $requests->requests_catatan  = $request->catatan;
            $respons = $requests->save();
    
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Requests created successfully.',
                'data' => $respons

            ], Response::HTTP_OK);
        }
    }

    
}
