<?php declare(strict_types=1);

namespace WyriHaximus\Recoil;

use React\EventLoop\LoopInterface;
use React\Promise\Promise;
use Recoil\React\ReactKernel;
use Rx\Subject\Subject;

final class PromiseCoroutineWrapper
{
    /** @var Subject */
    private $stream;

    private function __construct(Subject $stream)
    {
        $this->stream = $stream;
    }

    public static function createFromLoop(LoopInterface $loop): self
    {
        return self::createFromQueueCaller(
            new InfiniteCaller(
                ReactKernel::create($loop)
            )
        );
    }

    public static function createFromQueueCaller(QueueCallerInterface $caller): self
    {
        $stream = new Subject();
        $caller->call($stream);

        return new self($stream);
    }

    public function call(callable $callable, ...$args)
    {
        return new Promise(function ($resolve, $reject) use ($callable, $args): void {
            $call = new Call($callable, ...$args);
            $call->wait($resolve, $reject);
            $this->stream->onNext($call);
        });
    }
}
