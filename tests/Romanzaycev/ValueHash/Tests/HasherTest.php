<?php declare(strict_types=1);

namespace Romanzaycev\ValueHash\Tests;

use PHPUnit\Framework\TestCase;
use Romanzaycev\ValueHash\Exceptions\HashGenerationException;
use Romanzaycev\ValueHash\Hasher;
use Romanzaycev\ValueHash\Tests\Stubs\StubHashable;
use Romanzaycev\ValueHash\Tests\Stubs\StubObj;

class HasherTest extends TestCase
{
    /**
     * @throws HashGenerationException
     */
    public function testNull(): void
    {
        $this->assertEquals(
            "679091bc38dc6c9672bd4f0929fdcffbadc1d7145638e15541fe155298eeb31e",
            Hasher::hash(null)
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testInteger(): void
    {
        $this->assertEquals(
            "265bf97926248313abaa411695b117bfb17e99216326123ee80207df7e89b665",
            Hasher::hash(100500)
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testFloat(): void
    {
        $this->assertEquals(
            "63b098fdc1ee2e79d2e48b3d3ee8ff4e311d371b6de88fb9f9a07d6ff4a4dc6e",
            Hasher::hash(100.500)
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testString(): void
    {
        $this->assertEquals(
            "24875e2fdad08a841bd042c80b36730d2321e2e1b0bc9353cd8653828b7b1d0c",
            Hasher::hash("foo")
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testStringable(): void
    {
        $stub = new class implements \Stringable {
            public function __toString(): string
            {
                return "foo";
            }
        };
        $this->assertEquals(
            "24875e2fdad08a841bd042c80b36730d2321e2e1b0bc9353cd8653828b7b1d0c",
            Hasher::hash($stub),
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testTrue(): void
    {
        $this->assertEquals(
            "6a4080f461b75cd3150dee2f4b64f79c1fa89603ceb3e6d51ea4445b8bdc6765",
            Hasher::hash(true)
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testFalse(): void
    {
        $this->assertEquals(
            "93b4606ef0ccbcafefbafad4af7df1a6f1eb1c4cedf8aeec31b254f9c4aac585",
            Hasher::hash(false)
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testOne(): void
    {
        $this->assertEquals(
            "6a4080f461b75cd3150dee2f4b64f79c1fa89603ceb3e6d51ea4445b8bdc6765",
            Hasher::hash(1)
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testZero(): void
    {
        $this->assertEquals(
            "93b4606ef0ccbcafefbafad4af7df1a6f1eb1c4cedf8aeec31b254f9c4aac585",
            Hasher::hash(0)
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testArray(): void
    {
        $this->assertEquals(
            "e78e114fec7a4d0cd3ef1511f453f48a655ec927d5fb245fc7dce84fbfd598fe",
            Hasher::hash([
                1 => 1,
                "2" => [
                    "bar" => null,
                ],
            ])
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testDateTimeImmutable(): void
    {
        $dt = \DateTimeImmutable::createFromFormat("Y-m-d H:i:s", "2000-10-11 12:13:14");
        $this->assertEquals(
            "51d7c9b0ffadb03b9e7e3a177ce49c08ee4ad30afc5dc1e2a34f17ea4cc77187",
            Hasher::hash($dt),
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testDateTime(): void
    {
        $dt = \DateTime::createFromFormat("Y-m-d H:i:s", "2000-10-11 12:13:14");
        $this->assertEquals(
            "51d7c9b0ffadb03b9e7e3a177ce49c08ee4ad30afc5dc1e2a34f17ea4cc77187",
            Hasher::hash($dt),
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testStdClass(): void
    {
        $c = (object)[
            "b" => [1, 2, 3],
            "a" => 1,
        ];

        $this->assertEquals(
            "de8a2b8ac1c5ebfb02d83864379197da8205f5ba16f6664515f7560064d73e41",
            Hasher::hash($c),
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testAnonymousClass(): void
    {
        $c = new class {
            public int $a = 1;
            public array $b = [1, 2, 3];
            protected float $c = 1.1;
            private int $d = 1;
        };

        $this->assertEquals(
            "de8a2b8ac1c5ebfb02d83864379197da8205f5ba16f6664515f7560064d73e41",
            Hasher::hash($c),
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testClassInstance(): void
    {
        $this->assertEquals(
            "de8a2b8ac1c5ebfb02d83864379197da8205f5ba16f6664515f7560064d73e41",
            Hasher::hash(new StubObj()),
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testHashable(): void
    {
        $this->assertEquals(
            "ce93a3ff6c9c51cdf1e59c9db77fc5834022f1f9d1b510bdf2be0dafea1cefb7",
            Hasher::hash(new StubHashable(1)),
        );
    }

    /**
     * @throws HashGenerationException
     */
    public function testStdClassEqHashable(): void
    {
        $this->assertEquals(
            "ce93a3ff6c9c51cdf1e59c9db77fc5834022f1f9d1b510bdf2be0dafea1cefb7",
            Hasher::hash((object)["a" => "1"]),
        );
    }
}
