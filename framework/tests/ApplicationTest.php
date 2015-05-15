<?php
namespace Fly;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testDummy()
    {
        $app = new Application(1);
        $this->assertEquals(1, $app->router);
    }
}