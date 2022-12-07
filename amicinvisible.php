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

    /*
    $to      = 'nobody@example.com';
    $subject = 'the subject';
    $message = 'hello';
    $headers = 'From: webmaster@example.com'       . "\r\n" .
                 'Reply-To: webmaster@example.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
    */

    $subject = "NADAL 2022 :: a qui li fas el regal d\'amic o amiga invisible esta en aquest missatge :) !";
    $headers = 'From: amicinvisible@danielribes.com'       . "\r\n" .
               'Reply-To: amicinvisible@danielribes.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
    foreach($parelles as $unaParella)
    {
        $nomfa = $unaParella[0];
        $nomrep = $unaParella[1];
        $emaildesti = $correus[$nomfa];
        $missatge = "Hola $nomfa!!,\r\n\r\n T'ha tocat fer-li un regal a $nomrep.\r\n\r\n";
        mail($emaildesti, $subject, $missatge, $headers);
        echo "Enviat a $nomfa ($emaildesti)".PHP_EOL;
    }
}