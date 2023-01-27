<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
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
        $uuid = "uuid.value";

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
        $this->assertEquals("New Name", $category->name);
        $this->assertEquals("New desc", $category->description);
    }

    public function testExceptionName()
    {
        try {
            $category = new Category(
                name: "N",
                description: "New desc",
            );
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}
