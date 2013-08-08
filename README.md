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
            ->registerNode('Dashboard')
                ->setAttribute('id', 'dashboard-menu')
                ->setAttribute('class', 'nav nav-stacked')
                ->addNode('Users')
                    ->setAttribute('value', 'Dashboard')
                    ->setAttribute('title', 'Click to go to your dashboard')
                    ->setAttribute('href', '#');

        $menu = Menu::setNodes(Menu::getNodes());

        $node = $menu->registerNode('Users');
        $node->addNode('User list')
            ->setAttribute('value', 'User list')
            ->setAttribute('title', 'Click to go to your dashboard')
            ->setAttribute('href', '#');
        $node->addNode('New User')
            ->setAttribute('value', 'New User')
            ->setAttribute('title', 'Click to add a new user')
            ->setAttribute('href', '#');
        $node->addNode('Location List')
            ->setAttribute('value', 'Location List')
            ->setAttribute('title', 'Click to view user locations')
            ->setAttribute('href', '#');

    header('Content-Type: text/plain');
    print_r(Menu::render());
    exit();

Changelog
====

1.0.0
  - Initial setup of project
  - Boilerplate class content for really basic execution of logic
  - Creation of this file