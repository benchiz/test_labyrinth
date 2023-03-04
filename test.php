<?php
$maze = [[10], [10]];

echo "<h2>Лабиринт</h2>";
echo "<table>";
for ($u1 = 1; $u1 <= 10; $u1++) {
    echo "<tr>";
    for ($u2 = 1; $u2 <= 10; $u2++) {
        $val = round(rand(0, 5));
        if ($val < 2) {
            $maze[$u1][$u2] = 1;
            echo "<td>0</td>";
        } else {
            $maze[$u1][$u2] = 0;
            echo "<td>1</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";
error_reporting(0);
function findShortWay($x, $y, $x_to, $y_to, $maze)
{
    $size = 10;
    $matrix = [[$size][$size][3]];
    $added = true;
    $result = true;

    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            if ($maze[$i][$j] != 0) {
                $matrix[$i][$j][0] = -2;
            } else {
                $matrix[$i][$j][0] = -1;
            }
        }
    }
    $matrix[$x_to][$y_to][0] = 0;
    $step = 0;

    while ($added && $matrix[$x][$y][0] == -1) {
        $added = false;
        $step++;

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if ($matrix[$i][$j][0] == $step - 1) {
                    $i2 = $i + 1;
                    $j2 = $j;

                    if ($i2 >= 0 && $j2 >= 0 && $i2 < $size && $j2 < $size) {
                        if (
                            $matrix[$i2][$j2][0] == -1 &&
                            $matrix[$i2][$j2][0] != -2
                        ) {
                            $matrix[$i2][$j2][0] = $step;
                            $matrix[$i2][$j2][1] = $i;
                            $matrix[$i2][$j2][2] = $j;
                            $added = true;
                        }
                    }
                    $i2 = $i - 1;
                    $j2 = $j;

                    if ($i2 >= 0 && $j2 >= 0 && $i2 < $size && $j2 < $size) {
                        if (
                            $matrix[$i2][$j2][0] == -1 &&
                            $matrix[$i2][$j2][0] != -2
                        ) {
                            $matrix[$i2][$j2][0] = $step;
                            $matrix[$i2][$j2][1] = $i;
                            $matrix[$i2][$j2][2] = $j;
                            $added = true;
                        }
                    }
                    $i2 = $i;
                    $j2 = $j + 1;

                    if ($i2 >= 0 && $j2 >= 0 && $i2 < $size && $j2 < $size) {
                        if (
                            $matrix[$i2][$j2][0] == -1 &&
                            $matrix[$i2][$j2][0] != -2
                        ) {
                            $matrix[$i2][$j2][0] = $step;
                            $matrix[$i2][$j2][1] = $i;
                            $matrix[$i2][$j2][2] = $j;
                            $added = true;
                        }
                    }
                    $i2 = $i;
                    $j2 = $j - 1;

                    if ($i2 >= 0 && $j2 >= 0 && $i2 < $size && $j2 < $size) {
                        if (
                            $matrix[$i2][$j2][0] == -1 &&
                            $matrix[$i2][$j2][0] != -2
                        ) {
                            $matrix[$i2][$j2][0] = $step;
                            $matrix[$i2][$j2][1] = $i;
                            $matrix[$i2][$j2][2] = $j;
                            $added = true;
                        }
                    }
                }
            }
        }
    }

    if ($matrix[$x][$y][0] == -1) {
        $result = false;
    }

    if ($result) {
        $i2 = $x;
        $j2 = $y;

        while ($matrix[$i2][$j2][0] != 0) {
            $li = $matrix[$i2][$j2][1];
            $lj = $matrix[$i2][$j2][2];
            $i2 = $li;
            $j2 = $lj;
            $maze[$i2][$j2] = 7;
        }
    }
    return $maze;
}

$startX = 10;
$startY = 10;
$endX = 13;
$endY = 9;

$maze[$startX][$startY] = 0;
$maze[$endX][$endY] = 0;

$mazeEdited = findShortWay(2, 3, 7, 3, $maze);

echo "<h2>Результат</h2>";
echo "<table>";
for ($u1 = 1; $u1 <= 10; $u1++) {
    echo "<tr>";
    for ($u2 = 1; $u2 <= 10; $u2++) {
        if ($mazeEdited[$u1][$u2] == 1) {
            echo "<td style=\"background-color: #000\">0</td>";
        }
        if ($mazeEdited[$u1][$u2] == 0) {
            echo "<td style=\"background-color: #0f0\">1</td>";
        }
        if ($mazeEdited[$u1][$u2] == 7) {
            echo "<td>+</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";
?>
