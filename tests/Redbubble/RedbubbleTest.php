<?php

declare(strict_types=1);

namespace Tests\Redbubble;

use PHPUnit\Framework\TestCase;
use Redbubble\Redbubble;

class RedbubbleTest extends TestCase
{
    public function testItGreetsUser(): void
    {
        $greeting = new Greeting('Rasmus Lerdorf');

        $this->assertSame('Hello Rasmus Lerdorf', $greeting->sayHello());
    }
}
