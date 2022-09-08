<?php

global $item;
// an instance of a test item
$item = new StdClass();
$item->name = 'Laptop Acer Nitro 5';

// test prices
$price1 = new stdClass();
$price1->price = (int) 600345;
$price2 = new stdClass();
$price2->price = (int) 5004231;
$price3 = new stdClass();
$price3->price = (int) 1234;
$price4 = new stdClass();
$price4->price = (int) 2002347775;
$price5 = new stdClass();
$price5->price = (int) 15000;
$price6 = new stdClass();
$price6->price = (int) 456456456;
$price7 = new stdClass();
$price7->price = (int) 42879;

$item->prices = [$price1, $price2, $price3, $price4, $price5, $price6, $price7];

// optimised function
function getMinPrice(object $item): string
{
	return formatprice(getPriceFromObj(min($item->prices)));
	
	//fixed code
	/*$itemPricesArr = $item->prices;
	usort($itemPricesArr, function(object $a, object $b) {
		return $a->price - $b->price;
		});
	$objWithMinPrice = $itemPricesArr[0];
	return formatprice(getPriceFromObj($objWithMinPrice));*/
}

function formatPrice(int $price): string
{
	$price = (string) $price;
	return preg_replace('/\B(?=(\d{3})+(?!\d))/', ',',$price);
}

function getPriceFromObj(object $obj): int
{
  return $obj->price;
}

// demo
echo(getMinPrice($item));
