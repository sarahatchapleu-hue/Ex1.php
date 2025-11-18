<?php

// Fichier contenant les contacts

$fichier =  __DIR__ . "/contact.txt";

// Nouveaux contacts à ajouter

$Scontact = ["Alice Dupont", "John Doe", "Jean Martin"];

// Tableau pour stocker les contacts déjà présents

$contacts_existants = [];

// Vérifier si le fichier existe et lire son contenu

if (file_exists($fichier)) {

    $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lignes as $ligne) {

        echo $contacts_existants[] = trim($ligne);

    }

}

// Ouvrir le fichier en mode ajout

$fichier = fopen($fichier, "a");

// Ajouter les contacts uniquement s'ils ne sont pas déjà présents

foreach ($Scontact as $contact) {

    if (!in_array($contact, $contacts_existants)) {

        fwrite($fichier, $contact . PHP_EOL);

        echo "$contact ajouté<br>";

    } else {

        echo "$contact déjà présent, pas ajouté<br>";

    }

}

fclose($fichier);

?>
 