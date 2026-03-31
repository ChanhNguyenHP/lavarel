<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $results = [
            'success' => true,
            'message' => 'Thành công',
        ];

        try {     
            $users = User::select('id', 'name', 'email', 'created_at')->get();

            $results['data'] =  $users;

            return response()->json($results);

        } catch (\Exception $e) {

            $results['success'] =  false;
            $results['message'] =  'Failed to get user';
            $results['error'] =  $e->getMessage();

            return response()->json($results, 500);
        }
        
    }
}
