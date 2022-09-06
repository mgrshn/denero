<?php


/*
    Я, возможно, не совсем понял, что от меня требовалось в этом задании, но код из задания показался мне, мягко говоря, бессмысленным,
    поэтому моя оптимизация -- это удаление ничего не делающих кусков кода + замена форыча на ф-ю высшего порядка. По итогу функция работает также, как и работала. 
*/


$obj1 = new stdClass();
$obj1->site = 'site1.ru';
$obj2 = new stdClass();
$obj2->site = 'site2.ru';
$obj3 = new stdClass();
$obj3->site = 'site2.ru';


$items = new stdClass();

$items->obj1 = $obj1;
$items->obj2 = $obj2;
$items->obj3 = $obj3;

var_export(test($items));
function test(object $items): array
{
    $arrayOfItems = (array) $items;
    return array_reduce($arrayOfItems, function ($acc, $obj) {
        $acc[] = $obj->site;
        return $acc;
    }, []);
}
