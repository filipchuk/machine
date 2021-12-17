<?php
namespace App\Tests\Domain;

use App\Domain\Exceptions\ProductNotFoundException;
use App\Domain\ProductService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductServiceTest extends KernelTestCase
{
    private ProductService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $container = static::getContainer();

        /** @var ProductService $service */
        $service = $container->get(ProductService::class);
        $this->service = $service;
    }


    public function testNotFoundGetByName()
    {
        $this->expectException(ProductNotFoundException::class);
        $name = '123';
        $this->service->getByName($name);
    }

    public function testGetByName()
    {
        $name = 'A';
        $product = $this->service->getByName($name);
        $this->assertEquals($name, $product->getName()->getValue());
    }

}
