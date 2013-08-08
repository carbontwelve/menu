<?php namespace Carbontwelve\Menu;

/**
 * --------------------------------------------------------------------------
 * Carbontwelve\Menu Service Provider
 * --------------------------------------------------------------------------
 *
 * @package  Carbontwelve\Menu
 * @category Service Provider
 * @version  1.0.0
 * @author   Simon Dann <simon.dann@gmail.com>
 */

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('carbontwelve/menu');
        $this->registerMenuProvider();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

    protected function registerMenuProvider()
    {
        $app['carbontwelve.menu.loaded'] = true;
        $this->app['carbontwelve.menu'] = $this->app->share(function($app)
            {
                return new Menu();
            });
    }

}
