<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Types;

use Romanzaycev\ValueHash\TypeHasher;
use Romanzaycev\ValueHash\Types\Traits\ArrayTrait;
use Romanzaycev\ValueHash\Types\Traits\HashTrait;

final class ArrayHasher implements TypeHasher
{
    use HashTrait;
    use ArrayTrait;

    public function __construct(private array $values)
    {
    }

    public function hash(): string
    {
        return $this->sha256Hash(
            $this->sortAndImplode($this->recursiveArrayToArrayOfHashes($this->values))
        );
    }
}
