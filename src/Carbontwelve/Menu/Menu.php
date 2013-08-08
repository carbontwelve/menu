<?php namespace Carbontwelve\Menu;
/**
 * --------------------------------------------------------------------------
 * Carbontwelve\Menu
 * --------------------------------------------------------------------------
 *
 * I have designed the menu service to be as content agnostic as a menu service
 * can be.
 *
 * The default renderer is HTML, but you could easily write one for json, xml,
 * csv, etc... If you do, please fork this and issue a pull request with a unit test :)
 *
 * @package  Carbontwelve\Menu
 * @category Service
 * @version  1.0.0
 * @author   Simon Dann <simon.dann@gmail.com>
 */

use Carbontwelve\Menu\Interfaces\MenuInterface;
use Carbontwelve\Menu\RenderEngines\Html as DefaultRenderDriver;
use Carbontwelve\Menu\Interfaces\RendererDriverInterface;
use Carbontwelve\Menu\Interfaces\RendererInterface;

use Carbontwelve\Menu\Components\Node;
use Carbontwelve\Menu\Components\Renderer;

class Menu implements MenuInterface
{
    /** @var array */
    protected $nodes;

    /** @var \Carbontwelve\Menu\Components\Renderer */
    protected $renderer;

    /** @var \Carbontwelve\Menu\RenderEngines\Html */
    protected $renderDriver;

    public function __construct(
        RendererInterface $renderer = null,
        RendererDriverInterface $renderDriver = null)
    {
        $this->renderDriver = $renderDriver ?: new DefaultRenderDriver();
        $this->renderer = $renderer ?: new Renderer( $this->renderDriver );
    }

    /**
     * Register a node into this menu item
     *
     * @param $nodeName
     * @return mixed
     */
    public function registerNode( $nodeName )
    {
        $numberOfNodes = count($this->nodes);
        $this->nodes[$numberOfNodes] = new Node($nodeName);
        return $this->nodes[$numberOfNodes];
    }

    /**
     * Node Setter
     * This allows us to chain instances of Menu to build bigger
     * menus
     *
     * @param array $nodes
     * @return $this
     * @throws InvalidNodeException
     */
    public function setNodes ($nodes = null)
    {
        if ( is_null($nodes) ){ return $this; }
        if ( ! is_array($nodes) ){ throw new InvalidNodeException( 'Invalid input, was not an array' );}

        $this->nodes = $nodes;
        return $this;
    }

    /**
     * Node Getter
     *
     * @return array
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * Renderer Setter
     *
     * @param RendererDriverInterface $renderDriver
     * @return $this
     */
    public function setRenderer(RendererDriverInterface $renderDriver)
    {
        $this->renderDriver = $renderDriver;
        return $this;
    }

    /**
     * Renderer getter
     *
     * Default renderer is Html
     *
     * @return \Carbontwelve\Menu\RenderEngines\Html
     */
    public function getRenderer()
    {
        return $this->renderDriver;
    }

    /**
     * Render the content of $this->nodes using $this->renderer
     */
    public function render()
    {
        //return $this->nodes;
        return $this->renderer->compile($this->nodes);
    }

}
