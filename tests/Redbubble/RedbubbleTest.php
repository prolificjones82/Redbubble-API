<?php

declare(strict_types=1);

namespace Tests\Redbubble;

use PHPUnit\Framework\TestCase;
use Redbubble\Redbubble;

class RedbubbleTest extends TestCase
{
    public function testItRebubbleObject(): void
    {
        $redbubble = new Redbubble('prolific_lee');
        $this->assertInstanceOf(Redbubble::class, $redbubble);
    }

    public function testItRebubbleConfigObject(): void
    {
        $redbubble = new Redbubble('prolific_lee');
        $this->assertInstanceOf(Config::class, $redbubble->getConfig());
    }

    // public function testItRebubbleCacheObject(): void
    // {
    //     $redbubble = new Redbubble('prolific_lee');
    //     $this->assertInstanceOf(Redbubble::class, $redbubble);
    // }
}
