<?php

namespace App\Domain;

interface PaymentRepositoryInterface
{
    public function getPayment($input): Payment;
}

