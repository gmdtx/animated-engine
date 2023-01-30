<?php 

namespace Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;
use Throwable;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            $value = "";
            DomainValidation::notNull($value);

            $this->fail();
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testNotNullCustomMessageException()
    {
        try {
            $value = "";
            DomainValidation::notNull($value, "Custom message error");

            $this->fail();
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testStrMaxLength()
    {
        try {
            $value = "Test";
            DomainValidation::strMaxLength($value, 3, "Custom message");

            $this->fail();
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, "Custom message");
        }
    }

    public function testStrMinLength()
    {
        try {
            $value = "Test";
            DomainValidation::strMinLength($value, 8, "Custom message");

            $this->fail();
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, "Custom message");
        }
    }

    public function testStrCanNullAndMaxLength()
    {
        try {
            $value = "Test";
            DomainValidation::strCanNullAndMaxLength($value, 3, "Custom message");

            $this->fail();
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, "Custom message");
        }
    }
}
