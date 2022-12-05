<?php

namespace Romanzaycev\ValueHash\Tests\Stubs;

class StubObj
{
    public array $b = [1, 2, 3];

    protected int $c = 1;

    private int $d = 10;

    public function __construct(
        public $a = 1,
    )
    {
    }
}
