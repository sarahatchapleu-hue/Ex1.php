<?php
function school ($age) {
    if ($age < 3) {
        return "creche";
    } elseif ($age < 6) {
        return "maternelle";
    } elseif ($age < 11) {
        return "primaire";
    } elseif ($age < 16) {
        return "college";
    } elseif ($age < 18) {
        return "lycée";
    } else {
        return "rien";
    }
}
echo school (20);

for ($i = 1; $i <= 100; $i++) {
    if ($i % 15 == 0) {
        echo "FooBar\n";
    } elseif ($i % 3 == 0) {
        echo "Foo\n";
    } elseif ($i % 5 == 0) {
        echo "Bar\n";
    } else {
        echo $i . "\n";
    }

}

function doubleBoucle($n) {
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo $i;
        }
        echo "\n";
    }
}
echo doubleBoucle(5);
?>