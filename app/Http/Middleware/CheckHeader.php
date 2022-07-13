<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Api_header;

class CheckHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $get_header = $request->header('kotan-key');

        $check_header = Api_header::where('key', $get_header)->first();
        if ($check_header == null) {
            return response()->json([
                'message' => 'block',
                'data' => "Autorisasi Data Bermasalah"
            ]);
        }else {
            return $next($request);
        }
    }
}
