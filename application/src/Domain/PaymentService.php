<?php

namespace App\Domain;

class PaymentService
{

    private PaymentRepositoryInterface $repository;

    public function __construct(PaymentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function getPayment($input): Payment
    {
        return $this->repository->getPayment($input);
    }

}