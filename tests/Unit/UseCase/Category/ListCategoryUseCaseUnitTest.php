<?php

namespace Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\DTO\CategoryListInputDTO;
use Core\UseCase\Category\DTO\CategoryListOutputDTO;
use Core\UseCase\Category\ListCategoryUseCase;
use Exception;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class ListCategoryUseCaseUnitTest extends MockeryTestCase
{
    /**
     * @throws Exception
     */
    public function testGetById()
    {
        $id = Uuid::uuid4()->toString();

        $mockEntity = Mockery::mock(Category::class, [
            $id,
            'teste category',
        ]);
        $mockEntity->shouldReceive('id')->andReturn($id);
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $mockRepo->shouldReceive('findById')
            ->with($id)
            ->andReturn($mockEntity);

        $mockInputDto = Mockery::mock(CategoryListInputDTO::class, [
            $id,
        ]);

        $useCase = new ListCategoryUseCase($mockRepo);
        $response = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(CategoryListOutputDTO::class, $response);
        $this->assertEquals('teste category', $response->name);
        $this->assertEquals($id, $response->id);

        /**
         * Spies
         */
        $spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $spy->shouldReceive('findById')
            ->with($id)
            ->andReturn($mockEntity);
        $useCase = new ListCategoryUseCase($spy);
        $useCase->execute($mockInputDto);
        $spy->shouldHaveReceived('findById');
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}
