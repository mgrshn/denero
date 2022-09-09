<?php

//first type objects:
$testObj1 = (object) array(
    'title' => (string) 'first title',
    'price' => (int) 100,
    'size' => (string) '12kb'
); 

$testObj2 = (object) array(
    'title' => (string) 'second title',
    'price' => (int) 1900,
    'size' => (string) '600kb'
);

$testObj5 = (object) array(
    'title' => (string) 'fifth title',
    'price' => (int) 500,
    'size' => (string) '60kb'
); 
$testObj6 = (object) array(
    'title' => (string) 'first title',
    'price' => (int) 100,
    'size' => (string) '12kb'
); 

//second type objects:
$testObj3 = (object) array(
    'title' => (string) 'third title',
    'prices' => array(
        1 => (object) array(
            'price' => (int) 250,
            'size' => (string) '28kb'
        ),
        (object) array(
            'price' => (int) 550,
            'size' => (string) '38kb'
        ),
        (object) array(
            'price' => (int) 115,
            'size' => (string) '2mb'
        ),
        (object) array(
            'price' => (int) 600,
            'size' => (string) '45kb'
        )
    )
);
$testObj7 = (object) array(
    'title' => (string) 'third title',
    'prices' => array(
        1 => (object) array(
            'price' => (int) 250,
            'size' => (string) '28kb'
        ),
        (object) array(
            'price' => (int) 550,
            'size' => (string) '38kb'
        ),
        (object) array(
            'price' => (int) 115,
            'size' => (string) '2mb'
        ),
        (object) array(
            'price' => (int) 600,
            'size' => (string) '45kb'
        )
    )
);
$testObj4 = (object) array(
    'title' => (string) 'fourth title',
    'prices' => array(
        1 => (object) array(
            'price' => (int) 750,
            'size' => (string) '238kb'
        ),
        (object) array(
            'price' => (int) 5,
            'size' => (string) '498kb'
        ),
        (object) array(
            'price' => (int) 9567,
            'size' => (string) '8mb'
        ),
        (object) array(
            'price' => (int) 300,
            'size' => (string) '156kb'
        )
    )
);

class Item
{
    public string $title;
    public int $price;
    public string $size;
    public array $prices;
    public int $typeOfObject;

    private function __construct() { }
    // type of object -- тип объекта, где у 1 одна цена, у 2 несколько цен
    public static function createItem(int $typeOfObject, string $title)
    {
        $item = new self();
        if ($typeOfObject === 1) {
            $item->title = $title;
            $item->price = rand(100, 300);
            $item->size = (string) rand(1, 1000) . 'kb';
        } elseif ($typeOfObject === 2) {
            $item->title = $title;
            $item->prices = [];
            for ($i = rand(2,3), $arrIndex = 1; $i >= 0; $i--, $arrIndex++) {
                $subItem = new self();
                $subItem->price = rand(100, 300);
                $subItem->size = (string) rand(1, 1000) . 'kb';
                $item->prices[$arrIndex] = $subItem;
            }
        }
        return $item;
    }

    public static function getItemsInThePriceRange(int $minPrice, int $maxPrice, array $items): array
    {
        $filteredArray = array_filter($items, function ($item) use ($minPrice, $maxPrice) {
            if (isset($item->prices)) {

                // это плохо, но я ничего умнее пока не придумал.
                usort($item->prices, fn($first, $second) => $first->price - $second->price);
                $item->prices = array_combine(range(1, count($item->prices)), $item->prices);
                if (min($item->prices)->price > $minPrice && max($item->prices)->price < $maxPrice) {
                    return $item;
                }
            }
            elseif (!isset($item->prices) && $item->price > $minPrice && $item->price < $maxPrice) {
                return $item;
            }
        });

        $result = (array) array_reduce($filteredArray, function ($acc, $item) {
            if (!isset($item->prices)) {
                $price = $item->price;
                isset($acc[$price]) ? $acc[$price][] = $item : $acc[$price] = [1 => $item];
            } else {
               $price = min($item->prices)->price;
               isset($acc[$price]) ? $acc[$price][] = $item : $acc[$price] = [1 => $item];
            }
            return $acc;
        }, []);
        ksort($result, SORT_NUMERIC);
        return $result;
    }
}

//initializating of random testing values
$items = [];
for ($i = rand(10,30), $itemsIndex = 1; $i >= 0; $i--, $itemsIndex++) {
    $items[$itemsIndex] = Item::createItem(rand(1, 2), 'Item#' . $itemsIndex);
}
//для тестов с одними и теми же объектами:
//$items = [1 => $testObj1, $testObj2, $testObj3, $testObj4, $testObj5, $testObj6, $testObj7];

print_r(Item::getItemsInThePriceRange(120,275,$items));
