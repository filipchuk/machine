<?php

namespace App\Domain;

use Money\Money;

interface ISellable
{
    public function getPrice(): Money;
}
