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

echo PHP_EOL."Enviats!".PHP_EOL;


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
    
    $headers = 'From: amicinvisible@danielribes.com'. "\r\n".
               'Reply-To: amicinvisible@danielribes.com'. "\r\n".
               'Bcc: pixelsybytes@danielribes.com'. "\r\n".
               'X-Mailer: PHP/'. phpversion();
    foreach($parelles as $unaParella)
    {
        $nomfa = $unaParella[0];
        $nomrep = $unaParella[1];
        $emaildesti = $correus[$nomfa];
        $subject = "NADAL 2022 :: AMIC INVISIBLE de la família. $nomfa aquest missatge és només per mirar-lo tu!";
        $missatge = "Hola $nomfa!!,\r\n\r\nT'ha tocat fer-li un regal a *** ==> $nomrep <== *** :)\r\n\r\nRecorda que n'hi ha prou amb una manualitat o un detallet que no superi els 5€";
        mail($emaildesti, $subject, $missatge, $headers);
        echo "Enviat a $nomfa ($emaildesti)".PHP_EOL;
    }
}