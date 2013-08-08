<?php namespace Carbontwelve\Menu\Interfaces;

interface MenuNodeInterface {

    /**
     * Add a child node to this node
     *
     * @param string $nodeName
     * @return \Carbontwelve\Menu\Components\Node
     */
    public function addNode( $nodeName );

    /**
     * @param null $order
     * @return $this
     * @throws \Carbontwelve\Menu\InvalidNodeOrderException
     */
    public function setOrder( $order = null );

    /**
     * Attribute Setter
     *
     * @param null|string $name
     * @param null|string $value
     * @return $this
     * @throws \Carbontwelve\Menu\InvalidNodeAttributeException
     */
    public function setAttribute($name = null, $value = null);

    /**
     * Attribute Getter
     *
     * @param null|string $name
     * @return mixed
     * @throws \Carbontwelve\Menu\InvalidNodeAttributeException
     */
    public function getAttribute($name = null);

}
