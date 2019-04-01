<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Utility\Logger;

class SecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //step 1: you can use the following to get the route uri $request->path()
        //or $request->is()
        $path = $request->path();
        Logger::info("Entering Security Middleware in handle() at path: " . $path);
        
        //step 2: run the business rules that check for all uri's that dont need to be secure
        $secureCheck = true;
        if($request->is('/') || $request->is('homepage') || $request->is('login') ||
            $request->is('loginpage') || $request->is('register') || $request->is('registrationpage')
            || $request->is('profile/*')  || $request->is('jobs') || $request->is('jobs/*'))
        { $secureCheck = false; }
        Logger::info($secureCheck ? "Security Middleware in handle() ..... Needs Security" : "Security Middleware in handle() ...... No security required");
        
        //step 3: if entering a secure uri with no security token then do a redirect to the root uri or login page
        if ($secureCheck && session('userID') != null)
        {
            Logger::info("Leaving Security Middleware in handle() doing a redirect back to login");
            return redirect('/login');
        }
        
        //proceed as normal to next middleware in the chain
        return $next($request);
    }
}
