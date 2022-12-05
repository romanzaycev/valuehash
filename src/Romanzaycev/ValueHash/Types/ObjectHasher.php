<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Types;

use Romanzaycev\ValueHash\TypeHasher;
use Romanzaycev\ValueHash\Types\Traits\ArrayTrait;
use Romanzaycev\ValueHash\Types\Traits\HashTrait;

final class ObjectHasher implements TypeHasher
{
    use HashTrait;
    use ArrayTrait;

    public function __construct(private object $object)
    {
    }

    public function hash(): string
    {
        $propValues = get_object_vars($this->object);

        return $this->sha256Hash(
            $this->sortAndImplode($this->recursiveArrayToArrayOfHashes($propValues))
        );
    }
}
