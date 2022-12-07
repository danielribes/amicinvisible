<?php

declare(strict_types=1);

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
//  Aquest fitxer 'gent.php' es deixa fora del git
//
// -----------------------------------------------------------------

require_once('gent.php');

// =================================================================
//  Main Street
// =================================================================

$parelles = [];
$nomsA = array_keys($correus);
shuffle($nomsA);

$parelles = aparellaGent($nomsA);
enviaCorreus($parelles, $correus);


// =================================================================
//  Helpers
// =================================================================

/**
 * Retorna un array d'arrays associatius amb la gent aparellada
 * posant primer qui envia i segon qui rep.
 *
 * @param Array $noms
 * @return Array 
 */
function aparellaGent($noms): array
{
    $lesparelles = [];
    $ultimnom = count($noms)-1;
    $i = 0;
    foreach($noms as $unNom)
    {
        if($unNom == $noms[$ultimnom])
        {
            $lesparelles[] = [$unNom, $noms[0]];
        } else {
            $lesparelles[] = [$unNom, $noms[$i +1]];
        }
        $i++;
    }

    return $lesparelles;
}


/**
 * Crea i envia els correus a cada destinatari
 *
 * @param Array $parelles Array associatiu amb les parelles de gent
 * @param Array $correus Array amb noms i e-mails de cada persona
 * @return void
 */
function enviaCorreus($parelles, $correus): void
{
    foreach($parelles as $unaParella)
    {
        $nomfa = $unaParella[0];
        $nomrep = $unaParella[1];
        $email = $correus[$nomfa];
        echo "Hola $nomfa ($email) El teu amic/ga és: $nomrep";
        echo PHP_EOL;
    }
}