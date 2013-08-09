<?php

use Mockery as m;
use \Carbontwelve\Menu\Components\Node;

class NodeTest extends PHPUnit_Framework_TestCase {

    /**
     * Setup resources and dependencies.
     *
     * @return void
     */
    public function setUp()
    {

    }

    /**
     * Close mockery.
     *
     * @return void
     */
    public function tearDown()
    {
        //m::close();
    }

    /**
     * Test Node Class throws an exception when name not set
     *
     * @expectedException \Carbontwelve\Menu\InvalidNodeNameException
     */
    public function testNodeThrowsErrorWithNoNameTest()
    {
        $node = new Node();
    }

    /**
     * Test Node Class throws an exception when name is null
     *
     * @expectedException \Carbontwelve\Menu\InvalidNodeNameException
     */
    public function testNodeThrowsErrorWithNameSetToNullTest()
    {
        $node = new Node(null);
    }

    /**
     * Test Node Class throws an exception when name is an empty string
     *
     * @expectedException \Carbontwelve\Menu\InvalidNodeNameException
     */
    public function testNodeThrowsErrorWithNameSetToEmptyString()
    {
        $node = new Node('');
    }

    /**
     * Test Node Class setAttribute method throws exception when name not set
     *
     * @expectedException \Carbontwelve\Menu\InvalidNodeAttributeException
     */
    public function testNodeAttributesThrowsErrorWithNoNameSetTest()
    {
        $node = new Node('test');
        $node->setAttribute();
    }

    /**
     * Test Node Class setAttribute method throws exception when name is null
     *
     * @expectedException \Carbontwelve\Menu\InvalidNodeAttributeException
     */
    public function testNodeAttributesThrowsErrorWithNameSetToNullTest()
    {
        $node = new Node('test');
        $node->setAttribute(null, 'test');
    }

    /**
     * Test Node Class setAttribute method throws exception when name is empty string
     *
     * @expectedException \Carbontwelve\Menu\InvalidNodeAttributeException
     */
    public function testNodeAttributesThrowsErrorWithNameSetToEmptyStringTest()
    {
        $node = new Node('test');
        $node->setAttribute('', 'test');
    }

    /**
     * Test Node Class getName method returns Node->name as set on class __construct
     */
    public function testNodeName()
    {
        $node = new Node('test1234');
        $this->assertEquals( 'test1234', $node->getName() );
    }

    /**
     * Test Node Class getAttributes method returns an empty array on init
     * Test Node Class setAttributes method sets Node->attributes array correctly
     * Test Node Class setAttributes method modifies existing attribute correctly
     */
    public function testNodeAttributes()
    {

        $node = new Node('test');

        $initialArray = $node->getAttributes();

        // $initialArray should be an array of 0 elements
        $this->assertTrue( is_array($initialArray) );
        $this->assertEquals( 0, count($initialArray) );

        $node->setAttribute('test_attr_1', 'one');
        $node->setAttribute('test_attr_2', 'two');
        $node->setAttribute('test_attr_3', 'three');

        $modifiedArray = $node->getAttributes();

        // $modifiedArray should be an array of three elements
        $this->assertTrue( is_array($initialArray) );
        $this->assertEquals( 3, count($modifiedArray) );
        $this->assertEquals( array('test_attr_1' => 'one', 'test_attr_2' => 'two', 'test_attr_3' => 'three'), $modifiedArray );

        // Modifying an attribute should work correctly
        $this->assertEquals( 'one', $node->getAttribute('test_attr_1') );
        $node->setAttribute('test_attr_1', 'one-edited');
        $this->assertEquals( 'one-edited', $node->getAttribute('test_attr_1') );

        // Getting an attribute that does not exist should throw an exception
        // @todo write this test
        //$this->assertEquals( 'one-edited', $node->getAttribute('test_attr_999') );
    }

}
