<?php

namespace App\Factory;

use App\Entity\Link;
use App\Repository\LinkRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Link>
 *
 * @method        Link|Proxy                     create(array|callable $attributes = [])
 * @method static Link|Proxy                     createOne(array $attributes = [])
 * @method static Link|Proxy                     find(object|array|mixed $criteria)
 * @method static Link|Proxy                     findOrCreate(array $attributes)
 * @method static Link|Proxy                     first(string $sortedField = 'id')
 * @method static Link|Proxy                     last(string $sortedField = 'id')
 * @method static Link|Proxy                     random(array $attributes = [])
 * @method static Link|Proxy                     randomOrCreate(array $attributes = [])
 * @method static LinkRepository|RepositoryProxy repository()
 * @method static Link[]|Proxy[]                 all()
 * @method static Link[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Link[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Link[]|Proxy[]                 findBy(array $attributes)
 * @method static Link[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Link[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class LinkFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'fullLink' => self::faker()->url(),
            'shortLink' => self::faker()->url(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'author' => UserFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Link $link): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Link::class;
    }
}
