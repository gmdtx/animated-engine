<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\DTO\CategoryCreateInputDTO;
use Core\UseCase\Category\DTO\CategoryCreateOutputDTO;
use Exception;

class
CreateCategoryUseCase
{
    protected CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function execute(CategoryCreateInputDTO $input): CategoryCreateOutputDTO
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive
        );

        $newCategory = $this->repository->insert($category);

        return new CategoryCreateOutputDTO(
            id: $newCategory->id(),
            name: $newCategory->name,
            description: $newCategory->description,
            isActive: $newCategory->isActive
        );
    }
}
