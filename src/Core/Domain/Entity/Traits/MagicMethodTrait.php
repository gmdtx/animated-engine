<?php

namespace Core\Domain\Entity\Traits;

use Exception;

trait MagicMethodTrait
{
    public function __get($property)
    {
        if ($this->{$property}) return $this->{$property};
        
        $className = get_class($this);
        throw new Exception("Property {$property} not found in class {$className}");
    }
}