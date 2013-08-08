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
use Carbontwelve\Menu\InvalidNodeAttributeException;
use Carbontwelve\Menu\InvalidNodeOrderException;

class Node implements MenuNodeInterface {

    protected $order = 0;
    protected $name = '';
    protected $attributes = array();
    public $nodes = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Add a child node to this node
     *
     * @param string $nodeName
     * @return \Carbontwelve\Menu\Components\Node
     */
    public function addNode( $nodeName )
    {
        $numberOfNodes = count($this->nodes);
        $this->nodes[$numberOfNodes] = new Node($nodeName);
        return $this->nodes[$numberOfNodes];
    }

    /**
     * @param null $order
     * @return $this
     * @throws \Carbontwelve\Menu\InvalidNodeOrderException
     */
    public function setOrder( $order = null )
    {
        if ( is_null($order) || ! is_numeric($order) ){ throw new InvalidNodeOrderException( "[$order] can not be null and must be a number" ); }

        $this->order = $order;
        return $this;
    }

    /**
     * Attribute Setter
     *
     * @param null|string $name
     * @param null|string $value
     * @return $this
     * @throws \Carbontwelve\Menu\InvalidNodeAttributeException
     */
    public function setAttribute($name = null, $value = null)
    {
        if ( is_null($name) ){ throw new InvalidNodeAttributeException( "[$name] can not be null" ); }

        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * Attribute Atomic Getter
     *
     * @param null|string $name
     * @return mixed
     * @throws \Carbontwelve\Menu\InvalidNodeAttributeException
     */
    public function getAttribute($name = null)
    {
        if ( is_null($name) ){ throw new InvalidNodeAttributeException( "[$name] can not be null" ); }

        return $this->attributes[$name];
    }

    /**
     * Attribute Getter
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getName()
    {
        return $this->name;
    }


}
