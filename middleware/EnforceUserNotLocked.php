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
                if ($request->header('X_OCTOBER_REQUEST_HANDLER') == 'onUnlockSession')
                    return $next($request);
                throw new UnauthorizedException();
            } else {
                return (new Auth())->signout();
            }
        }
        return $next($request);
    }
}
