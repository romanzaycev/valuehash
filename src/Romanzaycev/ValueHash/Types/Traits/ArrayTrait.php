<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Types\Traits;

use Romanzaycev\ValueHash\Exceptions\HashGenerationException;
use Romanzaycev\ValueHash\Hasher;

trait ArrayTrait
{
    /**
     * @param string[]|array<string|int, string> $values
     */
    protected function sortAndImplode(array $values): string
    {
        $ret = [];

        foreach ($values as $k => $v) {
            $ret[(string)$k] = $v;
        }

        ksort($ret);

        return implode("|", array_map(static fn (string $k) => "$k:" . $ret[$k], array_keys($ret)));
    }

    /**
     * @param array $mixedValues
     * @return array<string, string>
     * @throws HashGenerationException
     */
    protected function recursiveArrayToArrayOfHashes(array $mixedValues): array
    {
        $result = [];

        foreach ($mixedValues as $key => $mixedValue) {
            $result[(string)$key] = Hasher::hash($mixedValue);
        }

        return $result;
    }
}
