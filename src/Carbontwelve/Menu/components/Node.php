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

use Carbontwelve\Menu\Interfaces\MenuNodeInterface;
use Carbontwelve\Menu\Components\Item;

class Node implements MenuNodeInterface {

    protected $order = 0;
    protected $name = '';
    protected $icon = '';
    public $items = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addItem( $itemName )
    {
        $numberOfItems = (count($this->items) > 1) ? (count($this->items) + 1) : 0;
        $this->items[$numberOfItems] = new Item($itemName);
        return $this->items[$numberOfItems];
    }

    public function setIcon( $iconName )
    {
        $this->icon = $iconName;
        return $this;
    }

}
