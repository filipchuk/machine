<?php

namespace App\Domain;

interface CoinsRepositoryInterface
{
    /**
     * @return array<Coin>
     */
    public function getAll(): array;
}