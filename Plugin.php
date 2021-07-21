<?php namespace Kpolicar\BackendLock;

use App;
use Backend;
use Backend\Classes\Controller as BackendController;
use Kpolicar\BackendLock\Behaviors\LockSessionController;
use Kpolicar\BackendLock\Exceptions\UnauthorizedException;
use Kpolicar\BackendLock\Middleware\EnforceUserNotLocked;
use System\Classes\PluginBase;
use BackendAuth;


/**
 * BackendLock Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'kpolicar.backendlock::lang.plugin.name',
            'description' => 'kpolicar.backendlock::lang.plugin.description',
            'author'      => 'Klemen Janez Poličar',
            'icon'        => 'icon-lock'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        App::error(function (UnauthorizedException $e) {
            return $e->getMessage() ?: e(trans('kpolicar.backendlock::lang.error.unauthorized'));
        });
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        if (!app()->runningInBackend())
            return;

        $this->app['Illuminate\Routing\Router']
            ->pushMiddlewareToGroup('web', EnforceUserNotLocked::class);

        BackendController::extend(function($controller) {
            if (BackendAuth::check()) {
                $controller->extendClassWith(LockSessionController::class);
                $controller->addCss('/plugins/kpolicar/backendlock/assets/css/menu.css');
                $controller->addJs('/plugins/kpolicar/backendlock/assets/js/menu.js', ['defer' => true]);
            }
        });

        \Event::listen('backend.layout.extendHead', function ($a) {
            if (BackendAuth::check()) {
                return $a->makeLayoutPartial('~/plugins/kpolicar/backendlock/layouts/_mainmenu_buttons');
            }
        });
    }
}
