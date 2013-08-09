<?php

use Mockery as m;
use \Carbontwelve\Menu\Menu;

class MenuTest extends PHPUnit_Framework_TestCase {

    /**
     * Setup resources and dependencies.
     *
     * @return void
     */
    public function setUp()
    {

    }

    /**
     * Close mockery.
     *
     * @return void
     */
    public function tearDown()
    {
        //m::close();
    }

    public function testMenuClass()
    {

        $firstLevel = new Menu();

        /** @var \Carbontwelve\Menu\Components\Node $node */
        $node = $firstLevel->registerNode('Menu Container');
        $node->setAttribute('id', 'dashboard-menu');
        $node->setAttribute('class', 'nav nav-stacked');
        $this->assertEquals('<ul id="dashboard-menu" class="nav nav-stacked"></ul>', $firstLevel->render());

        $node->addNode('Dashboard')
            ->setAttribute('href', '#');
        $this->assertEquals('<ul id="dashboard-menu" class="nav nav-stacked"><li><a href="#">Dashboard</a></li></ul>', $firstLevel->render());

        $usersNode = $node->addNode('Users')
            ->setAttribute('class', 'active')
            ->setAttribute('href', '#');

        $usersNodeSubMenu = $usersNode->addNode('subMenu')
            ->setAttribute('class', 'submenu');

        $usersNodeSubMenu->addNode('User List')
            ->setAttribute('href', '#');


        /*
        $usersNode = $node->addNode('Users')
            ->setAttribute('class', 'submenu')
            ->setAttribute('href', '#');
        $this->assertEquals('<ul id="dashboard-menu" class="nav nav-stacked"><li><a href="#">Dashboard</a></li><li class="submenu"><a href="#">Users</a></li></ul>', $firstLevel->render());

        $usersNode->addNode('User List')
            ->setAttribute('href', '#');

        $this->assertEquals('<ul id="dashboard-menu" class="nav nav-stacked"><li><a href="#">Dashboard</a></li><li><a href="#">Users</a><ul class="submenu"><li><a href="#">User List</a></li></ul></li></ul>', $firstLevel->render());

        $usersNode->addNode('New User')
            ->setAttribute('href', '#');
        $this->assertEquals('<ul id="dashboard-menu" class="nav nav-stacked"><li><a href="#">Dashboard</a></li><li><a href="#">Users</a><ul class="submenu"><li><a href="#">User List</a></li><li><a href="#">New User</a></li></ul></li></ul>', $firstLevel->render());

        $usersNode->addNode('Import Users')
            ->setAttribute('href', '#');
        $this->assertEquals('<ul id="dashboard-menu" class="nav nav-stacked"><li><a href="#">Dashboard</a></li><li><a href="#">Users</a><ul class="submenu"><li><a href="#">User List</a></li><li><a href="#">New User</a></li><li><a href="#">Import Users</a></li></ul></li></ul>', $firstLevel->render());
        */

        print_r($firstLevel->getNodes());
        print_r($firstLevel->render());

        echo "\n";

    }

}
