<?php

namespace Unit\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use stdClass;

class CreateCategoryUseCaseUnitTest extends MockeryTestCase
{
    public function testCreateNewCategory()
    {
//        $categoryId = '1';
//        $categoryName = 'Cat Name';
//        $mockEntity = Mockery::mock(Category::class, [
//            $categoryId,
//            $categoryName
//        ]);

        $mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $mockRepo->shouldReceive('insert'); //->andReturn($mockEntity);

        $useCase = new CreateCategoryUseCase($mockRepo);
        $useCase->execute();

        $this->assertTrue(true);

        Mockery::close();
    }
}
