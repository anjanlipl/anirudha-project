<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class XSS
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
        $input = $request->all();
        array_walk_recursive($input, function(&$input) {
            $input = strip_tags($input);
            $input = preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $input);
            // $regex = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?).*$)@";
            // $input = preg_replace($regex, ' ', $input);
        });
        $request->merge($input);
        return $next($request);
    }
}