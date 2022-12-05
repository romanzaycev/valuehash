<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Tests\Stubs;

use Romanzaycev\ValueHash\Hashable;

class StubHashable implements Hashable
{
    public function __construct(private int $a)
    {
    }

    public function hashableValues(): array
    {
        return [
            "a" => (string)$this->a,
        ];
    }
}
