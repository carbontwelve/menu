<?php namespace Carbontwelve\Menu\Renderers;
/**
 * --------------------------------------------------------------------------
 * Carbontwelve\Menu\Renderer
 * --------------------------------------------------------------------------
 *
 * @package  Carbontwelve\Menu
 * @category Renderer
 * @version  1.0.0
 * @author   Simon Dann <simon.dann@gmail.com>
 */

use Carbontwelve\Menu\Interfaces\RendererDriverInterface;

class Html implements RendererDriverInterface{

    public function render( array $nodes )
    {
        return $nodes;
    }

}
