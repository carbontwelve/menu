<?php namespace Carbontwelve\Menu\Interfaces;

interface MenuInterface {


    /**
     * Register a node into this menu item
     *
     * @param $nodeName
     * @return mixed
     */
    public function registerNode( $nodeName );

    /**
     * Node Setter
     * This allows us to chain instances of Menu to build bigger
     * menus
     *
     * @param array $nodes
     * @return $this
     * @throws InvalidNodeException
     */
    public function setNodes (array $nodes);

    /**
     * Node Getter
     *
     * @return array
     */
    public function getNodes();

    /**
     * Render the content of $this->nodes using $this->renderer
     */
    public function render();

}
