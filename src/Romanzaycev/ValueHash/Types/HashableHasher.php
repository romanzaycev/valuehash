<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Types;

use Romanzaycev\ValueHash\Exceptions\HashGenerationException;
use Romanzaycev\ValueHash\Hashable;
use Romanzaycev\ValueHash\TypeHasher;
use Romanzaycev\ValueHash\Types\Traits\ArrayTrait;
use Romanzaycev\ValueHash\Types\Traits\HashTrait;

final class HashableHasher implements TypeHasher
{
    use HashTrait;
    use ArrayTrait;

    public function __construct(private Hashable $hashable)
    {
    }

    public function hash(): string
    {
        $values = [];

        foreach ($this->hashable->hashableValues() as $key => $value) {
            if (!is_string($key)) {
                throw new HashGenerationException(
                    "Hashable values array must be a hashmap, not a list in class " . $this->hashable::class
                );
            }

            if (!is_string($value)) {
                $t = gettype($value);

                throw new HashGenerationException(
                    "Hashable values array must contains only string, not " . $t . " in class " . $this->hashable::class . ", key: " . $key
                );
            }

            $values[$key] = $value;
        }

        return (new ObjectHasher((object)$values))->hash();
    }
}
