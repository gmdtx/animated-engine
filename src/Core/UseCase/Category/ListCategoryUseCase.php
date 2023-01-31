<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\DTO\CategoryListInputDTO;
use Core\UseCase\Category\DTO\CategoryListOutputDTO;

class ListCategoryUseCase
{
    protected CategoryRepositoryInterface $repository;

    public function __construct(
        CategoryRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function execute(CategoryListInputDTO $input): CategoryListOutputDTO
    {
        $category = $this->repository->findById($input->id);

        return new CategoryListOutputDTO(
            id: $category->id(),
            name: $category->name,
            description: $category->description,
            isActive: $category->isActive
        );
    }
}
