<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

use CNastasi\DDD\Examples\DummyCollection;
use CNastasi\DDD\Examples\DummyEntity;
use CNastasi\DDD\ValueObject\IntegerIdentifier;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @package CNastasi\DDD\Collection
 *
 * @covers \CNastasi\DDD\Collection\AbstractCollection
 */
class AbstractCollectionTest extends TestCase
{
    use ProphecyTrait;
    
    public function test_empty_collection(): void
    {
        $coll = new DummyCollection();
        self::assertEquals(0, $coll->count());
    }
    
    public function test_set_add_item(): void
    {
        $coll = new DummyCollection();
        $entity = new DummyEntity(new IntegerIdentifier(1));
        $coll->addItem($entity);
        
        self::assertEquals(1, $coll->count());
    }
    
    public function test_first(): void
    {
        $coll = new DummyCollection();
        $entity = new DummyEntity(new IntegerIdentifier(1));
        $entity2 = new DummyEntity(new IntegerIdentifier(2));
        $coll->addItem($entity);
        $coll->addItem($entity2);
        
        self::assertEquals($entity, $coll->first());
    }
    
    public function test_has_key(): void
    {
        $coll = new DummyCollection();
        $entity = new DummyEntity(new IntegerIdentifier(1));
        $coll->addItem($entity);
        
        self::assertTrue($coll->hasKey(0));
        self::assertFalse($coll->hasKey(1));
    }
    
    public function test_has(): void
    {
        $coll = new DummyCollection();
        $entity = new DummyEntity(new IntegerIdentifier(1));
        $coll->addItem($entity);
        
        self::assertTrue($coll->has($entity));
        self::assertFalse($coll->has(new DummyEntity(new IntegerIdentifier(2))));
    }
    
    public function test_get(): void
    {
        $coll = new DummyCollection();
        $entity = new DummyEntity(new IntegerIdentifier(1));
        $entity2 = new DummyEntity(new IntegerIdentifier(2));
        $coll->addItem($entity);
        $coll->addItem($entity2);
        
        self::assertEquals($entity, $coll->get(0));
        self::assertEquals($entity2, $coll->get(1));
    }
    
    public function test_filter(): void
    {
        $coll = new DummyCollection();
        $entity = new DummyEntity(new IntegerIdentifier(1));
        $coll->addItem($entity);
        
        $filtered = $coll->filter(static fn (DummyEntity $entity) => true);
        
        self::assertEquals(1, $filtered->count());
    
        $filtered = $coll->filter(static fn (DummyEntity $entity) => false);
    
        self::assertEquals(0, $filtered->count());
        self::assertEquals(1, $coll->count());
    }
    
    public function test_map(): void
    {
        $coll = new DummyCollection();
        $entity = new DummyEntity(new IntegerIdentifier(1));
        $coll->addItem($entity);
        
        $mapped = $coll->map(static fn (DummyEntity $e) => $e->getId()->value());
        
        self::assertEquals([1], $mapped);
    }
}
