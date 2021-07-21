<?php namespace Kpolicar\BackendLock\Behaviors;

use Backend\Models\User as BackendUser;
use BackendAuth;
use Backend\Classes\ControllerBehavior;
use Illuminate\Support\Facades\Session;
use Kpolicar\BackendLock\Exceptions\UnauthorizedException;
use October\Rain\Auth\AuthException;
use October\Rain\Exception\ValidationException;

class LockSessionController extends ControllerBehavior
{
    public const SessionKey = 'kpolicar_backendlock_locked';


    public function onLockSession()
    {
        Session::put('kpolicar_backendlock_locked', true);
    }

    public function onUnlockSession()
    {
        $user = BackendAuth::user();
        $login = $user->{BackendUser::$loginAttribute};
        $credentials = [
            BackendUser::$loginAttribute => $login,
            'password' => post('password'),
        ];

        try {
            if (BackendAuth::validate($credentials)) {
                Session::forget('kpolicar_backendlock_locked');
            }
        } catch (AuthException $exception) {
            throw new ValidationException([
                'password' => trans('kpolicar.backendlock::lang.error.password')
            ]);
        }
    }
}
