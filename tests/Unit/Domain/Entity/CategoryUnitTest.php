<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Throwable;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: "New Cat",
            description: "New desc",
            isActive: true
        );
        $this->assertNotEmpty($category->id());
        $this->assertEquals("New Cat", $category->name);
        $this->assertEquals("New desc", $category->description);
        $this->assertEquals(true, $category->isActive);
    }

    public function testActivated()
    {
        $category = new Category(
            name: "New Cat",
            isActive: false
        );
        $this->assertFalse($category->isActive);

        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testDeactivated()
    {
        $category = new Category(
            name: "New Cat"
        );
        $this->assertTrue($category->isActive);

        $category->deactivate();
        $this->assertFalse($category->isActive);
    }

    public function testUpdate()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: "New Cat",
            description: "New desc",
            isActive: true
        );

        $category->update(
            name: "New Name",
            description: "New desc"
        );
        $this->assertEquals($uuid, $category->id());
        $this->assertEquals("New Name", $category->name);
        $this->assertEquals("New desc", $category->description);
    }

    public function testExceptionName()
    {
        try {
            new Category(
                name: "Na",
                description: "New desc",
            );
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testExceptionDescription()
    {
        try {
            new Category(
                name: "Na",
                description: random_bytes(8888888),
            );
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}
