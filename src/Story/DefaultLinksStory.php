<?php

namespace App\Story;

use App\Factory\LinkFactory;
use Zenstruck\Foundry\Story;

final class DefaultLinksStory extends Story
{
    public function build(): void
    {
        // TODO build your story here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#stories)
        LinkFactory::createMany(30);
    }
}
