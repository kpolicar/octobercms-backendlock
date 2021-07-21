<?php namespace Kpolicar\BackendLock;

use Backend;
use Backend\Classes\Controller as BackendController;
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
            'name'        => 'BackendLock',
            'description' => 'No description provided yet...',
            'author'      => 'Kpolicar',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

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

        BackendController::extend(function($controller) {
            if (BackendAuth::check()) {
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

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Kpolicar\BackendLock\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'kpolicar.backendlock.some_permission' => [
                'tab' => 'BackendLock',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'backendlock' => [
                'label'       => 'BackendLock',
                'url'         => Backend::url('kpolicar/backendlock/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['kpolicar.backendlock.*'],
                'order'       => 500,
            ],
        ];
    }
}
