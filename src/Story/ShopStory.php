<?php

declare(strict_types=1);

namespace App\Story;

use Zenstruck\Foundry\Attribute\AsFixture;
use Zenstruck\Foundry\Story;

#[AsFixture(name: 'shop')]
final class ShopStory extends Story
{
    public function build(): void
    {
        // SomeFactory::createOne();
    }
}
