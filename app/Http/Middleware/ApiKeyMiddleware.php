<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $secret  = $request->header('secret');
        $user = User::where('secret', $secret)->first();
        $check = Hash::check($user->api_key, $secret);
        if ($check) {
            if ($user->apikey_status == 'active') {

                $response = $next($request);
                $response->headers->set('Access-Control-Allow-Origin', '*');
                $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
                $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
                return $response;
                
            } else {

                return response([
                    'status' => 'failed',
                    'message' => 'Inactive Valid Api Key',
                    'data' => []
                ], 401);
            }
        } else {

            return response([
                'status' => 'failed',
                'message' => 'No Valid Api Key',
                'data' => []
            ], 401);
        }
    }
}
