<?php

declare(strict_types=1);

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
// En aquest fitxer també definim les variables per l'enviament
// de correu:
//
// $fromEmail
// $replyEmail
// $bccEmail
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
$parelles = aparellaGent($nomsA);
enviaCorreus($parelles, $correus, $fromEmail, $replyEmail, $bccEmail);
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
    shuffle($noms);

    $lesParelles = [];
    $ultimNom = count($noms)-1;
    $i = 0;
    foreach($noms as $unNom)
    {
        if($unNom == $noms[$ultimNom])
        {
            $lesParelles[] = [$unNom, $noms[0]];
        } else {
            $lesParelles[] = [$unNom, $noms[$i +1]];
        }
        $i++;
    }

    return $lesParelles;
}


/**
 * Crea i envia els correus a cada destinatari
 *
 * @param Array $parelles Array associatiu amb les parelles de gent
 * @param Array $correus Array amb noms i e-mails de cada persona
 * @return void
 */
function enviaCorreus($parelles, $correus, $fromEmail, $replyEmail, $bccEmail): void
{
    
    $headers = "From: $fromEmail\r\n".
               "Reply-To: $replyEmail\r\n".
               "Bcc: $bccEmail\r\n".
               'X-Mailer: PHP/'. phpversion();
    foreach($parelles as $unaParella)
    {
        $nomfa = $unaParella[0];
        $nomrep = $unaParella[1];
        $emaildesti = $correus[$nomfa];
        $subject = "Bon Nadal! :: AMIC INVISIBLE de la família. $nomfa aquest missatge és només per mirar-lo tu!";
        $missatge = "Hola $nomfa!!,\r\n\r\nT'ha tocat fer-li un regal a *** ==> $nomrep <== *** :)\r\n\r\nRecorda que n'hi ha prou amb una manualitat o un detallet que no superi els 5€";
        mail($emaildesti, $subject, $missatge, $headers);
        echo "Enviat a $nomfa ($emaildesti)".PHP_EOL;
    }
}