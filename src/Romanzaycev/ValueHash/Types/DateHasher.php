<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Types;

use Romanzaycev\ValueHash\TypeHasher;
use Romanzaycev\ValueHash\Types\Traits\HashTrait;

final class DateHasher implements TypeHasher
{
    use HashTrait;

    public function __construct(private \DateTimeInterface $value)
    {
    }

    public function hash(): string
    {
        return $this->sha256Hash($this->value->format(\DATE_RFC3339_EXTENDED));
    }
}
