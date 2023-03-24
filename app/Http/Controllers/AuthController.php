<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'goldar' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([

                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $validator->errors(),
                'data' => []

            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }else{
            $user = new User;
            $user->name  = $request->name;
            $user->email  = $request->email;
            $user->goldar  = $request->goldar;
            $user->password  = Hash::make($request->password);
            $user->remember_token  = Str::random(60);
            $respons = $user->save();
    
            return response()->json([

                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Register successfully.',
                'data' => $respons

            ], Response::HTTP_OK);
        }
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'response' => Response::HTTP_UNAUTHORIZED,
                'success' => false,
                'message' => 'Unauthorized',
                'data' => [],
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
        // return dd(Auth::user()->id);  
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'response' => Response::HTTP_OK,
            'success' => true,
            'message' => 'Successfully logged out',
            'data' => [],
        ], Response::HTTP_OK);    
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'response' => Response::HTTP_OK,
            'success' => true,
            'message' => 'Login Successfully',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], Response::HTTP_OK);
    }
}
