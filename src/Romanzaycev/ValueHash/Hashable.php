<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash;

interface Hashable
{
    /**
     * @return array<string, string>
     */
    public function hashableValues(): array;
}
