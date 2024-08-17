<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $result = JWTToken::verifyToken($token);

        if($result == 'unauthorized'){
            // return response()->json([
            //     'status' => 'fail',
            //     'message' => 'Unauthorized user'
            // ], 401);

            return redirect('/login');

        }else{
            // $request->headers->set('email', $result->userEmail);
            // $request->headers->set('id', $result->userId);

            $request->headers->set('email', $result->userEmail);
            $request->headers->set('id', $result->userId);

            return $next($request);
        }


        
    }
}
