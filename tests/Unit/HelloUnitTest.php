<?php

namespace Tests\Unit;

use Core\Hello;
use PHPUnit\Framework\TestCase;

class HelloUnitTest extends TestCase
{
    public function test_call_method_foo()
    {
        $hello = new Hello();
        $response = $hello->foo();

        $this->assertEquals('123', $response);
        $this->assertNotEquals('1234', $response);
    }
}
