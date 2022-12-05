<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Types\Traits;

trait HashTrait
{
    protected function sha256Hash(string $val): string
    {
        return hash("sha256", "__X_OBJHASHER_" . $this->getName(static::class) . "_" . $val);
    }

    private function getName(string $fqn): string
    {
        $path = explode('\\', $fqn);

        return array_pop($path);
    }
}
