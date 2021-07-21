<?php namespace Kpolicar\BackendLock\Behaviors;

use BackendAuth;
use Backend\Classes\ControllerBehavior;
use Illuminate\Support\Facades\Session;

class LockSessionController extends ControllerBehavior
{
    public const SessionKey = 'kpolicar_backendlock_locked';


    public function onLockSession()
    {
        Session::put('kpolicar_backendlock_locked', true);

        return [
//            '@#layout-mainmenu .js-pinned-pages' =>
//                $this->makeLayoutPartial('~/plugins/kpolicar/backendmenupinnedpages/layouts/_mainmenu_pinned_items')
        ];
    }
}
