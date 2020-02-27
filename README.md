# CyberusKey PHP

Ready to use PHP class which heavily simplify process of integration your very own CyberusKey.

## Instalation 

Use the dependency manager [composer](https://getcomposer.org/) to install CyberusKey.

```bash
composer require cyberuslabs/cyberkey
```

## Usage

```php
require_once __DIR__ . '/vendor/autoload.php';

$cyberkey = new Cyberlabs\Cyberkey(
  '[CLIENT_ID]',
  '[SECRET_KEY]',
  '[REDIRECT_URL]'
);

try {
  $result = $cyberkey->send_code();

  // $result will contain object with all  your profile information.
} catch(Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(); 
}
```