<?php namespace Carbontwelve\Menu\Components;
/**
 * --------------------------------------------------------------------------
 * Carbontwelve\Menu\RenderFactory
 * --------------------------------------------------------------------------
 *
 * @package  Carbontwelve\Menu
 * @category Factory
 * @version  1.0.0
 * @author   Simon Dann <simon.dann@gmail.com>
 */

use Carbontwelve\Menu\Interfaces\RendererInterface;
use Carbontwelve\Menu\Interfaces\RendererDriverInterface;

class Renderer implements RendererInterface {

    /** @var \Carbontwelve\Menu\Components\DefaultRenderDriver  */
    protected $renderDriver;

    public function __construct(
        RendererDriverInterface $renderDriver = null)
    {
        $this->renderDriver = $renderDriver;
    }

    public function compile( array $nodes)
    {
        return $this->renderDriver->render($nodes);
    }

}
