<?php

namespace Foo\Test\Unit;

use MVC\Config;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        display(
            Config::get_MVC_BASE_PATH()
        );

        $this->assertTrue(true);
    }
}
