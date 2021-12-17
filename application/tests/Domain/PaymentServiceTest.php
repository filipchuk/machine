<?php

namespace App\Tests\Domain;

use App\Domain\Coin;
use App\Domain\PaymentService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PaymentServiceTest extends KernelTestCase
{
    private PaymentService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $container = static::getContainer();

        /** @var PaymentService $service */
        $service = $container->get(PaymentService::class);
        $this->service = $service;
    }


    public function testCoinsFromString()
    {
        $input = '5 2 1 50  50 50 50 20 25 10 10 5 2 2 1 1 33 99';

        $payment = $this->service->getPayment($input);

        $this->assertInstanceOf(Coin::class, $payment->getCoins()->get()[0]);
    }

    public function testCoinsFromArray()
    {
        $input = [1, 2, 3, 5];

        $payment = $this->service->getPayment($input);

        $this->assertEquals(5, $payment->getCoins()->get()[3]->getAmount()->getAmount());
    }

    public function testExcludeLessEqualZeroCoins()
    {
        $input = [1, -3, 0, 2, 3, 5];

        $payment = $this->service->getPayment($input);

        $this->assertCount(4, $payment->getCoins()->get());
    }
}
