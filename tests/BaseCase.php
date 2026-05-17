<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class BaseCase extends WebTestCase
{

    use Factories;
    use ResetDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $_ENV['APP_ENV'] = 'test';
        $_SERVER['APP_ENV'] = 'test';

        self::bootKernel([
            'environment' => 'test',
            'debug'       => true,
        ]);
    }

}