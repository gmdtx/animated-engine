<?php

namespace Core\UseCase\Category\DTO;

class CategoryListOutputDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description = '',
        public bool $isActive = true,
    )
    {

    }
}