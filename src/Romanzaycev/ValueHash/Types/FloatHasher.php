<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Types;

use Romanzaycev\ValueHash\TypeHasher;
use Romanzaycev\ValueHash\Types\Traits\HashTrait;

final class FloatHasher implements TypeHasher
{
    use HashTrait;

    public function __construct(private float $value)
    {
    }

    public function hash(): string
    {
        return $this->sha256Hash((string)$this->value);
    }
}
