<?php
// Exercice 2.1
function calcMoy( array $numbers) {
    if(count($numbers)===0){
        return 0;
    }
    $sum = 0;

    foreach ($numbers as $num) {
        $sum += $num;
    }

    return $sum / count ($numbers);
}

echo calcMoy([5,10,20,30,40]);


//Exercice 2.2
function my_strrev (string $str): string {
    $reversed = "";
    $length = strlen($str);

    for ($i = $length - 1; $i >=0; $i--) {
        $reversed .= $str[$i];
    }
    return $reversed;
}
echo my_strrev ("Bonjour");


// Exercice 2.3

function my_str_contains(string $haystack, string $needle): bool
{
   $lenHay = strlen($haystack);
   $lenNeedle = strlen($needle);
   
   if ($lenNeedle === 0) {
       return true;
   }
   if ($lenNeedle > $lenHay) {
       return false;
   }
   
   for ($i = 0; $i <= $lenHay - $lenNeedle; $i++) {
       $found = true;
    for ($j = 0; $j < $lenNeedle; $j++) {
        if ($haystack[$i + $j] !== $needle[$j]) {
        $found = false;
         break;
    }
       }
       if ($found) {
           return true;
       }
   }
   return false;
}
var_dump(my_str_contains("Bonjour", "jour"));   
var_dump(my_str_contains("Bonjour", "xyz"));    
var_dump(my_str_contains("abc", ""));           
var_dump(my_str_contains("abc", "abcd"));       
?>



