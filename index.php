<?php
function show($var)
{
    echo json_encode($var) . '<br>';
}

function inRange($element, $range)
{
    if ($element >= $range[0] && $element <= $range[1]) {
        return true;
    }
    return false;
}

function minMax($array)
{
    $min = $array[0][0];
    $max = $array[0][1];
    foreach ($array as $item) {
        if ($item[0] < $min) {
            $min = $item[0];
        }
        if ($item[0] > $max) {
            $max = $item[0];
        }
        if ($item[1] < $min) {
            $min = $item[1];
        }
        if ($item[1] > $max) {
            $max = $item[1];
        }
    }
    return [$min, $max];
}

function foo($array)
{
    // On définit l'intervalle principale
    $interval = minMax($array);
    $result[0] = $interval[0];
    /*
    On cherche parcours chaque éléments de l'intervalle principale et on cherche si ils peuvent correspondre
    aux intervalles contenus dans le tableau.
    */

    for ($x = $interval[0]; $x < $interval[1]; $x++) {
        $inRange = false;
        for ($y = 0; $y < sizeof($array); $y++) {
            if (inRange($x, $array[$y])) {
                $inRange = true;
                $result[1] = $x;
            }
        }
        if ($inRange == false) {
            if ($result[1] !== null) {
                $bilan[] = $result;
                $result[1] = null;
            }
            $result[0] = $x + 1;
        }
    }
    /* 
    Si notre variable bilan est null c'est que chaque éléments de l'intervalle principale à trouver sa place
    dans le tableau donc on renvoit directement l'intervalle principale.
    */
    if ($bilan == null) {
        show($interval);
    } else {
        $result[1] = $interval[1];
        $bilan[] = $result;
        show($bilan);
    }
    echo '<br>';
}


foo([[0, 3], [6, 10]]);
foo([[0, 5], [3, 10]]);
foo([[0, 5], [2, 4]]);
foo([[7, 8], [3, 6], [2, 4]]);
foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]);
?>