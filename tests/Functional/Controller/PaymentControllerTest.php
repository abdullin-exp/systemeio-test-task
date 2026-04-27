<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Tests\BaseCase;
use App\Tests\Resource\Story\ShopStory;
use JetBrains\PhpStorm\NoReturn;

class PaymentControllerTest extends BaseCase
{

    #[NoReturn]
    public function testSuccessPurchaseWithCoupon(): void
    {
        ShopStory::load();

        $requestData = [
            'product'          => '019dce4e-f2fd-772c-8d07-dc7e967043c3',
            'taxNumber'        => 'IT12345678900',
            'couponCode'       => 'PERCENT',
            'paymentProcessor' => 'stripe',
        ];

        self::ensureKernelShutdown();
        $client = self::createClient();

        $client->jsonRequest(
            method: 'POST',
            uri: '/purchase',
            parameters: $requestData,
        );

        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode());
    }

    #[NoReturn]
    public function testSuccessPurchaseWithoutCoupon(): void
    {
        ShopStory::load();

        $requestData = [
            'product'          => '019dce4f-271e-70f8-9d8e-6114025495cb',
            'taxNumber'        => 'DE123456789',
            'couponCode'       => 'ABSOLUTE',
            'paymentProcessor' => 'paypal',
        ];

        self::ensureKernelShutdown();
        $client = self::createClient();

        $client->jsonRequest(
            method: 'POST',
            uri: '/purchase',
            parameters: $requestData,
        );

        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode());
    }

    #[NoReturn]
    public function testFailPurchaseTooHighPrice(): void
    {
        ShopStory::load();

        $requestData = [
            'product'          => '019dce4e-f2fd-772c-8d07-dc7e967043c3',
            'taxNumber'        => 'DE123456789',
            'paymentProcessor' => 'paypal',
        ];

        self::ensureKernelShutdown();
        $client = self::createClient();

        $client->jsonRequest(
            method: 'POST',
            uri: '/purchase',
            parameters: $requestData,
        );

        $response = $client->getResponse();

        self::assertSame(500, $response->getStatusCode());
    }
}