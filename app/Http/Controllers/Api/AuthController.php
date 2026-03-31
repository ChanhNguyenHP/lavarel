<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $results = [
            'success' => true,
            'message' => 'Thành công',
        ];
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $results['user'] =  $user;

            return response()->json($results, 201);

        } catch (\Exception $e) {

            $results['success'] =  false;
            $results['message'] =  'Failed to register user';
            $results['error'] =  $e->getMessage();

            return response()->json($results, 500);
        }
    }

    // LOGIN
    public function login(Request $request)
    {
        $results = [
            'success' => true,
            'message' => 'Thành công',
        ];
       
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $results['success'] =  false;
            $results['message'] =  'Tài khoản hoặc mật khẩu không đúng';
            return response()->json($results);
        }

        $token = $user->createToken('mobile_token')->plainTextToken;
        $results['user'] =  $user;
        $results['token'] =  $token;

        return response()->json($results);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
