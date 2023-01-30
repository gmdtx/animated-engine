<?php

namespace Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\Category\DTO\CategoryCreateInputDTO;
use Core\UseCase\Category\DTO\CategoryCreateOutputDTO;
use Exception;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateCategoryUseCaseUnitTest extends MockeryTestCase
{
    /**
     * @throws Exception
     */
    public function testCreateNewCategory()
    {
        $uuid = Uuid::uuid4()->toString();
        $categoryName = 'name cat';

        $mockEntity = Mockery::mock(Category::class, [
            $uuid,
            $categoryName,
        ]);
        $mockEntity->shouldReceive('id')->andReturn($uuid);

        $mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $mockRepo->shouldReceive('insert')->andReturn($mockEntity);

        $mockInputDto = Mockery::mock(CategoryCreateInputDto::class, [
            $categoryName,
        ]);

        $useCase = new CreateCategoryUseCase($mockRepo);
        $responseUseCase = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(CategoryCreateOutputDto::class, $responseUseCase);

        /**
         * Spies
         */
        $spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $spy->shouldReceive('insert')->andReturn($mockEntity);
        $useCase = new CreateCategoryUseCase($spy);
        $useCase->execute($mockInputDto);
        $spy->shouldHaveReceived('insert');

        Mockery::close();
    }
}
