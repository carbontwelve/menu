Menu Class
====

Framework agnostic menu provider, initially written for Laravel

This is currently very much alpha and is pretty much just boiler plate. I will be working on finishing this soon

Install
====

Eventually this will be on composer :) until then copy the menu directory to `vendor/carbontwelve`... I guess...

**Laravel** To install in laravel open your `app/config/app.php` file and add the following to the `providers` array:

    'Carbontwelve\Menu\MenuServiceProvider',

and add the following to the `aliases` array:

    'Menu'            => 'Carbontwelve\Menu\Facades\Menu',

Once complete you will be able to do something like the following to be able to see things.

    Menu::setNodes(Menu::getNodes())
        ->registerNode('Test')
        ->setIcon('user')
        ->addItem('Users');

    print_r(Menu::render());

Changelog
====

1.0.0
  - Initial setup of project
  - Boilerplate class content for really basic execution of logic
  - Creation of this file