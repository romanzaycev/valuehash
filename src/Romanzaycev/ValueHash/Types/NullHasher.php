<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Types;

use Romanzaycev\ValueHash\TypeHasher;
use Romanzaycev\ValueHash\Types\Traits\HashTrait;

final class NullHasher implements TypeHasher
{
    use HashTrait;

    public function hash(): string
    {
        return $this->sha256Hash("");
    }
}
