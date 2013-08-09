<?php namespace Carbontwelve\Menu\RenderEngines;
/**
 * --------------------------------------------------------------------------
 * Carbontwelve\Menu\Renderer
 * --------------------------------------------------------------------------
 *
 * Turns the input $nodes array into a pretty HTML list with the following
 * rules.
 *
 * If a node has just one child then that node is a link in its own right
 * and should be outputted as such:
 *
 * <li>
 *     <a></a>
 * </li>
 *
 * If a node has more than one child then that node is a group and should
 * be outputted as such:
 * <li>
 *     <a></a>
 *     <ul class="submenu">
 *         ...
 *     </ul>
 * </li>
 *
 * The ideal structure of nodes should be as such:
 *
 * Node{
 *     'attributes' => {
 *         'id' => 'dashboard-menu',
 *         'class' => 'nav nav-stacked',
 *     },
 *     'nodes' => {
 *          0 => Node{
 *              'name' => 'Dashboard',
 *              'nodes' => {
 *                  0 => Node{
 *                      'name' => 'Dashboard',
 *                      'attributes' => {
 *                          'href' => '#',
 *                      }
 *                      'nodes' => {}
 *                  },
 *                  1 => Node{
 *                      'name' => 'Users',
 *                      'attributes' => {
 *                          'data-toggle' => 'dropdown',
 *                          'class' => 'dropdown-toggle',
 *                          'href' => '#'
 *                      },
 *                      'icon' => 'icon-user',
 *                      'nodes' => {
 *                          0 => Node{
 *                              'name' => 'Add User',
 *                              'attributes' => {
 *                                  'href' => '#'
 *                              },
 *                          },
 *                          1 => Node{
 *                              'name' => 'View Users',
 *                              'attributes' => {
 *                                  'href' => '#'
 *                              }
 *                          }
 *                      }
 *                  }
 *              }
 *          }
 *     }
 * }
 *
 * Which should output the following HTML
 *
 * <ul id="dashboard-menu" class="nav nav-stacked">
 *  <li>
 *      <a href="#">Dashboard</a>
 *  </li>
 *  <li>
 *      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
 *          <i class="icon-user"></i>
 *          <span>Users</span>
 *          <i class="icon-chevron-down"></i>
 *      </a>
 *      <ul class="submenu">
 *          <li><a href="#">Add User</a></li>
 *          <li><a href="#">View Users</a></li>
 *      </ul>
 *  </li>
 * </ul>
 *
 * This should be built as a unit test; as you can see the menu class is very expandable and it
 * is down to the RenderEngines to do the grunt work of actually providing an output. I will
 * write in a few Engines to do tasks that I use the menu class for, however it is up to you to
 * write your own as the Engine can be passed to the menu class via the setRenderer method :)
 *
 * @package  Carbontwelve\Menu
 * @category Renderer
 * @version  1.0.0
 * @author   Simon Dann <simon.dann@gmail.com>
 */

use Carbontwelve\Menu\Interfaces\RendererDriverInterface;

class Html implements RendererDriverInterface{

    protected $allowedAttributes = array(
        'id', 'class', 'href', 'data-toggle', 'value'
    );

    protected $allowedUlAttributes = array(
        'id', 'class'
    );

    protected $allowedLiAttributes = array(
        'id', 'class'
    );

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

            // Is our depth equal to zero?
            if ($depth === 0)
            {
                $html .= $this->beginUnorderedList( $node->getAttributes() );
                if (count($node->nodes) > 0)
                {
                    $html .= $this->recursiveLoop($node->nodes, ($depth + 1));
                }
                $html .= $this->endUnorderedList();
            }else{

                if (count($node->nodes) > 0)
                {
                    $html .= $this->beginUnorderedListItem( $node->getAttributes(), array('id') );
                    $html .= $this->linkNode( $node->getAttributes(), $node->getName(), array('href') );
                    $html .= $this->beginUnorderedList( $node->getAttributes() );
                    //$html .= '<ul class="submenu">';
                    $html .= $this->recursiveLoop($node->nodes, ($depth + 1));
                    $html .= $this->endUnorderedList();
                    $html .= $this->endUnorderedListItem();

                }else{

                    // Are we a link?
                    $html .= $this->beginUnorderedListItem( $node->getAttributes() );
                    $html .= $this->linkNode( $node->getAttributes(), $node->getName(), array('href') );
                    $html .= $this->endUnorderedListItem();

                    //$html .= $this->returnUnorderedListItem( $node->getAttributes(), $node->getName() );
                }

            }
        }

        return $html;

    }

    private function beginUnorderedList( array $attributes )
    {
        $output = '<ul';
        foreach ($attributes as $attribute => $value)
        {
            if ( in_array($attribute, $this->allowedUlAttributes))
            {
                $output .= ' ' . $attribute . '="' . $value .'"';
            }
        }

        $output .= '>';
        return $output;

    }

    private function endUnorderedList()
    {
        return '</ul>';
    }

    private function beginUnorderedListItem( array $attributes, $allowedAttributes = null )
    {

        if (is_null($allowedAttributes))
        {
            $allowedAttributes = $this->allowedLiAttributes;
        }

        $output = '<li';
        foreach ($attributes as $attribute => $value)
        {
            if ( in_array($attribute, $allowedAttributes))
            {
                $output .= ' ' . $attribute . '="' . $value .'"';
            }
        }

        $output .= '>';
        return $output;
    }

    private function endUnorderedListItem()
    {
        return '</li>';
    }

    private function linkNode( array $attributes, $nodeName, $allowedAttributes = null )
    {
        $textValue = ( isset( $attributes['value'] ) ) ? $attributes['value'] : $nodeName;

        if (is_null($allowedAttributes))
        {
            $allowedAttributes = $this->allowedAttributes;
        }

        $output = '<a';
        foreach ($attributes as $attribute => $value)
        {
            if ( in_array($attribute, $allowedAttributes))
            {
                $output .= ' ' . $attribute . '="' . $value .'"';
            }
        }

        $output .= '>' . $textValue . '</a>';
        return $output;
    }




}
