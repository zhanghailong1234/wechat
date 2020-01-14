<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $user=session("user");
        // dd($user);
        if(!$user){
            echo "<script>alert('请先登陆!');location='/admin/login'</script>";
        }

        return $next($request);
    }
}
