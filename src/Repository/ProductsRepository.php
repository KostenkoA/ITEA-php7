<?php
declare(strict_types=1);

/**
 * ITEA PHP 7
 */

namespace App\Repository;

class ProductsRepository
{
    const DEFAULT_LIMIT = 50;

    private $products = [
        'PHPStrom',
        'WebStorm',
        'Visual Studio',
    ];

    public function getAll(): array
    {
        return [];
    }

    public function getProductForSale(array $filter)
    {
//        $limit = null;
//
//        if (isset($filter['limit'])) {
//            $limit = $filter['limit'];
//        }

        $limit = $filter['limit'] ?? self::DEFAULT_LIMIT;

        return $limit;
    }

    public function count(array $filters): int
    {
        return '0';
    }

    public function getProductCollection()
    {
        $products = $this->products;

        return new class($products) implements \ArrayAccess {

            private $items;

            public function __construct($items)
            {
                $this->items = $items;
            }

            public function offsetExists($offset)
            {
                return isset($this->items[$offset]);
            }

            public function offsetGet($offset)
            {
                return $this->items[$offset];
            }

            public function offsetSet($offset, $value)
            {
                throw $this->createReadOnlyException();
            }

            public function offsetUnset($offset)
            {
                throw $this->createReadOnlyException();
            }

            private function createReadOnlyException()
            {
                return new \LogicException('Products collection is read only');
            }
        };
    }
}
