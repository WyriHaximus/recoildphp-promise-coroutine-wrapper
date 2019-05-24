<?php declare(strict_types=1);

namespace WyriHaximus\Tests\Recoil;

use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use WyriHaximus\AsyncTestUtilities\AsyncTestCase;
use function WyriHaximus\React\timedPromise;
use WyriHaximus\Recoil\PromiseCoroutineWrapper;

/**
 * @internal
 */
final class PromiseCoroutineWrapperTest extends AsyncTestCase
{
    public function testConcurrencyOfOne(): void
    {
        \gc_collect_cycles();

        $loop = Factory::create();

        $wrapper = PromiseCoroutineWrapper::createFromLoop($loop);

        $wait = \random_int(1, 3);
        $result = $this->await($wrapper->call(function (LoopInterface $loop, int $wait) {
            yield timedPromise($loop, $wait);

            return $wait;
        }, $loop, $wait), $loop, 5);

        self::assertSame($wait, $result);

        self::assertSame(0, \gc_collect_cycles());
    }
}
