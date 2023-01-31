<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Category;
use PaginationInterface;

interface CategoryRepositoryInterface
{
    public function insert(Category $category): Category;
    public function findById(string $id): Category;
    public function findAll(string $filter = '', $order = 'DESC'): array;
    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;
    public function delete(string $id): bool;
    public function toCategory(object $data): Category;
}
