<?php

function walk(array $array)
{
    $result = [];
    $elements = array_map(function ($row) {
        return reset($row);
    }, $array);

    while (true) {
        $result[] = $elements;

        foreach ($array as $key => &$row) {
            if ($element = next($row)) {
                $elements[$key] = $element;

                continue 2;
            }

            $elements[$key] = reset($row);
        }

        break;
    };

    return $result;
}

function reverseWalk(array $array)
{
    $result = array_map(function (array $row) {
        return array_reverse($row);
    }, walk(array_reverse($array)));

    return $result;
}

$array = [[1,2,3,4,5], ['x', 'y'], [6,7,8,9]];
$walkResult = reverseWalk($array);

foreach ($walkResult as $row) {
    echo implode(' ', $row) . "\n";
}