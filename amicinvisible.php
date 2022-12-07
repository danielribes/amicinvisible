<?php

// =================================================================
//  Config
// =================================================================

// -----------------------------------------------------------------
//  Espera un fitxer 'gent.php' amb un array associatiu anomenat
//  $correus on la 'key' és el nom i el 'value' és el e-mail,
//  exemple:
//
//  $correus = ['Nom1' => 'email1@mail.com',
//              'Nom2' => 'email2@mail.com',
//              'Nom3' => 'email3@mail.com',
//              (...)
//
//  Aquesta fitxer 'gent.php' es deixa fora del git
//
// -----------------------------------------------------------------

require_once('gent.php');

// =================================================================
//  Main Street
// =================================================================

$parelles = [];
$nomsA = array_keys($correus);
shuffle($nomsA);

$i = 0;
foreach($nomsA as $unNom)
{
    if($unNom == $nomsA[count($nomsA)-1])
    {
        $parelles[] = [$unNom, $nomsA[0]];
    } else {
        $parelles[] = [$unNom, $nomsA[$i +1]];
    }
    $i++;
}

foreach($parelles as $unaParella)
{
    $nomfa = $unaParella[0];
    $nomrep = $unaParella[1];
    $email = $correus[$nomfa];
    echo "Hola $nomfa ($email) El teu amic/ga és: $nomrep";
    echo PHP_EOL;
}
