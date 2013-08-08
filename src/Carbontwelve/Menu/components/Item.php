<?php namespace Carbontwelve\Menu\Components;
/**
 * --------------------------------------------------------------------------
 * Carbontwelve\Menu\Components
 * --------------------------------------------------------------------------
 *
 * @package  Carbontwelve\Menu
 * @category Component
 * @version  1.0.0
 * @author   Simon Dann <simon.dann@gmail.com>
 */

use Carbontwelve\Menu\Interfaces\MenuItemInterface;

class Item implements MenuItemInterface {

    protected $name = '';
    protected $route = '';
    protected $class = '';
    protected $allowed = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

}
