<?php

namespace App\Tests\Domain;

use App\Domain\MachineService;
use App\Domain\PaymentService;
use App\Domain\SellChange;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MachineServiceTest extends KernelTestCase
{
    private MachineService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $container = static::getContainer();

        /** @var MachineService $service */
        $service = $container->get(MachineService::class);
        $this->service = $service;
    }


    public function testSell()
    {
        $productName = 'A';
        $coins = [10, 20, 10, 50, 90, 85, 5, 2, 1, 1, 5, 50, 50, 20, 10, 50];

        $container = static::getContainer();
        /** @var PaymentService $paymentService */
        $paymentService = $container->get(PaymentService::class);
        $payment = $paymentService->getPayment($coins);

        $result = $this->service->sell($productName, $payment);

        $this->assertInstanceOf(SellChange::class, $result);
    }
}
