<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Jumbojett\OpenIDConnectClient;
use App\Helpers\OIDCHelper;

class CustomAuthMiddleware
{
   public function handle($request, Closure $next)
   {
      // Perform action
      if(Auth::check()) {
         if(Auth::user()->is_admin) {
            return $next($request);                
         } else {
            return Redirect('/unauthorized');
         }
      } else {
         OIDCHelper::auth();
      }
   }
}
