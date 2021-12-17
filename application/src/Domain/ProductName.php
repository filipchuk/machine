<?php

namespace App\Domain;

class ProductName
{
    private string $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = strtoupper($value);
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(self $name): bool
    {
        return $this->getValue() === $name->getValue();
    }

}