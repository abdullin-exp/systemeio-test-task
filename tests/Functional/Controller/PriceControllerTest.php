<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Tests\BaseCase;
use App\Tests\Resource\Story\ShopStory;
use JetBrains\PhpStorm\NoReturn;

class PriceControllerTest extends BaseCase
{

    #[NoReturn]
    public function testSuccessCalculatePriceWithCoupon(): void
    {
        ShopStory::load();

        $requestData = [
            'product'    => '019dce4e-f2fd-772c-8d07-dc7e967043c3',
            'taxNumber'  => 'DE123456789',
            'couponCode' => 'ABSOLUTE',
        ];

        self::ensureKernelShutdown();
        $client = self::createClient();

        $client->jsonRequest(
            method: 'POST',
            uri: '/calculate-price',
            parameters: $requestData,
        );

        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode());
    }

    #[NoReturn]
    public function testSuccessCalculatePriceWithoutCoupon(): void
    {
        ShopStory::load();

        $requestData = [
            'product'   => '019dce4e-f2fd-772c-8d07-dc7e967043c3',
            'taxNumber' => 'DE123456789',
        ];

        self::ensureKernelShutdown();
        $client = self::createClient();

        $client->jsonRequest(
            method: 'POST',
            uri: '/calculate-price',
            parameters: $requestData,
        );

        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode());
    }

    #[NoReturn]
    public function testFailCalculatePriceWasProductNotFound(): void
    {
        ShopStory::load();

        $requestData = [
            'product'    => '019dcf64-3f90-77b3-b03f-13990ebe8890',
            'taxNumber'  => 'DE123456789',
            'couponCode' => 'ABSOLUTE',
        ];

        self::ensureKernelShutdown();
        $client = self::createClient();

        $client->jsonRequest(
            method: 'POST',
            uri: '/calculate-price',
            parameters: $requestData,
        );

        $response = $client->getResponse();

        self::assertSame(422, $response->getStatusCode());
    }
}