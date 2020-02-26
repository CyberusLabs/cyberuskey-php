# CyberusKey PHP

Ready to use PHP class which heavily simplify process of integration your very own CyberusKey.

## Usage

```php
$cyberkey = new Cyberkey(
  '[CLIENT_ID]',
  '[SECRET_KEY]',
  '[REDIRECT_URL]'
);

$cyberkey->send_code();
$result = $cyberkey->result;
```