<?php

namespace {module}\Tests\Unit;

use MVC\Config;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        var_dump(
            Config::get_MVC_LOG_FILE_DEFAULT()
        );

        $this->assertTrue(true);
    }
}
