<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $User;

    public function __construct(User $User)
    {
        $this->User = $User;
    }

    public function handle($request, Closure $next)
    {
        //dd($request);
        dd($request->input());
        return $next($request);
    }
}
