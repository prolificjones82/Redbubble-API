<?php

declare(strict_types=1);

namespace Tests\Redbubble;

use PHPUnit\Framework\TestCase;
use Redbubble\Redbubble;
use Redbubble\Config;
use Redbubble\Cache;

class RedbubbleTest extends TestCase
{
    public function testItRedbubbleObject(): void
    {
        $redbubble = new Redbubble('prolific_lee');
        $this->assertInstanceOf(Redbubble::class, $redbubble);
    }

    public function testItRedbubbleConfigObject(): void
    {
        $redbubble = new Redbubble('prolific_lee');
        $this->assertInstanceOf(Config::class, $redbubble->getConfig());
    }

    public function testItRedbubbleCacheObject(): void
    {
        $redbubble = new Redbubble('prolific_lee');
        $this->assertInstanceOf(Cache::class, $redbubble->getCache());
    }

    public function testItUsernameIsString()
    {
        $redbubble = new Redbubble('prolific_lee');
        $this->assertIsString($redbubble->getConfig()->getUsername());
    }
}
