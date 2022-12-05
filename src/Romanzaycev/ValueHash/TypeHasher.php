<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash;

use Romanzaycev\ValueHash\Exceptions\HashGenerationException;

interface TypeHasher
{
    /**
     * @throws HashGenerationException
     */
    public function hash(): string;
}
