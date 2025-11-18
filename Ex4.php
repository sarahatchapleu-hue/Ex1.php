<?php
// Exercice 4.1
$eleves = [
    ["nom" => "Alice", "notes" => [15, 14, 16]],

    ["nom" => "Bob", "notes" => [12, 10, 11]],

    ["nom" => "Claire", "notes" => [18, 17, 16]]
];

foreach ($eleves as $eleve) {
    $nom = $eleve["nom"];
    $notes = $eleve["notes"];

    // Calcul de la moyenne
    $moyenne = array_sum($notes) / count($notes);
    echo "Élève : $nom - Moyenne : " . round($moyenne, 2) . "<br>";

}

 // Exercice 4.2
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
var_dump(my_str_contains("hello", "hello world"));   
var_dump(my_str_contains("hello world", "hello"));    
var_dump(my_str_contains("the hello the world", "the w"));           
var_dump(my_str_contains("hello the world", "world"));
var_dump(my_str_contains("hello the world", "world is big"));  

 // Exercice 4.3

 $fichier = "table.txt";
$table_size = 10;
$output = "";
for ($i = 1; $i <= $table_size; $i++) {
    for ($j = 1; $j <= $table_size; $j++) {
        $output .= str_pad($i * $j, 4, ' ', STR_PAD_LEFT);
    }
    $output .= PHP_EOL;
}
echo nl2br($output);
file_put_contents($fichier, $output);  
?>