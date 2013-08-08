<?php namespace Carbontwelve\Menu\RenderEngines;
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
        return $this->recursiveLoop($nodes);
    }

    /**
     * I cant think of a way of making this prettier
     *
     * @param array $nodes
     * @param int   $depth
     * @return string
     */
    private function recursiveLoop( array $nodes, $depth = 0 )
    {

        $html = '';

        /** @var $node \Carbontwelve\Menu\Components\Node */
        foreach ($nodes as $node)
        {

            if (count($node->nodes) > 0)
            {
                $html .= $this->beginListNode( $node->getAttributes() );
                $html .= $this->linkNode( $node->getAttributes(), $node->getName() );
                $html .= $this->recursiveLoop($node->nodes, ($depth + 1));
                $html .= $this->endListNode();
            }else{
                $html .= "\t<li>\n";
                $html .= $this->linkNode( $node->getAttributes(), $node->getName() );
                $html .= "\t</li>\n";
            }
        }

        return $html;

    }

    private function linkNode( array $attributes, $nodeName )
    {
        $textValue = ( isset( $attributes['value'] ) ) ? $attributes['value'] : $nodeName;
        $output = "\t\t<a";

        if ( isset( $attributes['id'] ) )
        {
            $output .= ' id="'. $attributes['id'] .'"';
        }

        if ( isset( $attributes['class'] ) )
        {
            $output .= ' class="'. $attributes['class'] .'"';
        }

        if ( isset( $attributes['title'] ) )
        {
            $output .= ' title="'. $attributes['title'] .'"';
        }

        if ( isset( $attributes['alt'] ) )
        {
            $output .= ' alt="'. $attributes['alt'] .'"';
        }

        if ( isset( $attributes['href'] ) )
        {
            $output .= ' href="'. $attributes['href'] .'"';
        }

        $output .= ">$textValue</a>\n";
        return $output;
    }

    private function beginListNode( array $attributes )
    {

        $output  = '<ul';

        if ( isset( $attributes['id'] ) )
        {
            $output .= ' id="'. $attributes['id'] .'"';
        }

        if ( isset( $attributes['class'] ) )
        {
            $output .= ' class="'. $attributes['class'] .'"';
        }

        $output .= ">\n";

        return $output;
    }

    private function endListNode()
    {
        return "</ul>\n";
    }



}
