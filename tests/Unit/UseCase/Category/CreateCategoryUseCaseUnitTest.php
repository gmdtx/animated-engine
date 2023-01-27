<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateCategoryUseCaseUnitTest extends MockeryTestCase
{
    public function testCreateNewCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'name cat';

        $mockEntity = Mockery::mock(Category::class, [
            $uuid,
            $categoryName,
        ]);
        $mockEntity->shouldReceive('id')->andReturn($uuid);
    }
}
