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

$cyberkey = new Cyberuslabs\Cyberkey(
  '[CLIENT_ID]',
  '[SECRET_KEY]',
  '[REDIRECT_URL]'
);

try {
  $result = $cyberkey->authenticate();
  var_dump($result);
  // $result will contain object with all  your profile information.
} catch(Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(); 
}
```

## Methods

```php
// In case you need to change these
$cyberkey->set_public_key('[PUBLIC_KEY]');
$cyberkey->set_api_address('[API_ADDRESS]');
```