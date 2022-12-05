<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash;

use Romanzaycev\ValueHash\Exceptions\HashGenerationException;
use Romanzaycev\ValueHash\Types\ArrayHasher;
use Romanzaycev\ValueHash\Types\DateHasher;
use Romanzaycev\ValueHash\Types\FloatHasher;
use Romanzaycev\ValueHash\Types\HashableHasher;
use Romanzaycev\ValueHash\Types\IntegerHasher;
use Romanzaycev\ValueHash\Types\NullHasher;
use Romanzaycev\ValueHash\Types\ObjectHasher;
use Romanzaycev\ValueHash\Types\StringHasher;

final class Hasher
{
    /**
     * @throws Exceptions\HashGenerationException
     */
    public static function hash(mixed $object): string
    {
        if (is_resource($object)) {
            throw new HashGenerationException("Unsupported object type: resource");
        }

        if (is_float($object) && is_infinite($object)) {
            throw new HashGenerationException("Unsupported object type: infinite");
        }

        if ($object instanceof \Generator) {
            throw new HashGenerationException("Unsupported object type: generator");
        }

        if (is_string($object) || $object instanceof \Stringable) {
            return (new StringHasher((string)$object))->hash();
        }

        if (is_null($object)) {
            return (new NullHasher())->hash();
        }

        if (is_integer($object) || is_bool($object)) {
            return (new IntegerHasher((int)$object))->hash();
        }

        if (is_float($object)) {
            return (new FloatHasher($object))->hash();
        }

        if (is_object($object)) {
            if ($object instanceof Hashable) {
                return (new HashableHasher($object))->hash();
            }

            if ($object instanceof \DateTimeInterface) {
                return (new DateHasher($object))->hash();
            }

            return (new ObjectHasher($object))->hash();
        }

        if (is_array($object)) {
            return (new ArrayHasher($object))->hash();
        }

        throw new HashGenerationException("Unsupported object type: " . gettype($object));
    }
}
