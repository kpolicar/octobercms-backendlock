<?php namespace Kpolicar\BackendLock\Middleware;

use Backend\Classes\AuthManager;
use Backend\Controllers\Auth;
use Closure;
use Kpolicar\BackendLock\Behaviors\LockSessionController;
use Kpolicar\BackendLock\Exceptions\UnauthorizedException;

class EnforceUserNotLocked
{

    public function handle($request, Closure $next)
    {
        if ($request->session()->get(LockSessionController::SessionKey)) {
            if ($request->ajax()) {
                throw new UnauthorizedException("You must re-enter your credentials.");
            } else {
                return (new Auth())->signout();
            }
        }
        return $next($request);
    }
}
