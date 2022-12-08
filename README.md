# Amic Invisible

Programa basic per fer l'Amic invisible.

D'una llista de persones/e-mails, les aparella aleatoriament i envia correus a cadascú per comunicar a qui li ha tocat fer-li un regal.

Funciona des de la línia d'ordres i amb PHP7.4 minim.

## Configuració

El fitxer __amicinvisible.php__ espera un fitxer anomenat __gent.php__ amb un array associatiu anomenat **$correus** on la 'key' és el nom i el 'value' és el e-mail.

Exemple:
```php
$correus = ['Nom1' => 'email1@mail.com',
            'Nom2' => 'email2@mail.com',
            'Nom3' => 'email3@mail.com',
              (...)
```
En aquest fitxer també definim les variables per l'enviament
dels correus:

```php
$fromEmail
$replyEmail
$bccEmail
```

Per executar-lo:

```php
$ php amicinvisible.php
````
