<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodTrait;

class Category
{
    use MagicMethodTrait;

    public function __construct(
        protected string $id = '',
        protected string $name,
        protected string $description,
        protected bool $isActive = true,
    )
    {
        
    }
}