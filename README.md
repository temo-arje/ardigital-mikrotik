# Mikrotik Router API Laravel


## Table of Contents

- [Installation](#installation)
- [Usage](#usage)

## Installation

```
composer require ardigital/mikrotik
```

#### For Laravel <= 6.x

Open `config/app.php` and add `MikrotikServiceProvider` to the `providers` array.

```php
'providers' => [
   ArDigital\Mikrotik\MikrotikServiceProvider::class,
],
```

Then run:

```
php artisan vendor:publish --provider="ArDigital\Mikrotik\MikrotikServiceProvider"
```

Place Mikortik username and password configuration  `config/mikrotik.php` file Or .env : 
 
```
 
MIKROTIK_IP=10.10.0.1
MIKROTIK_USERNAME=user
MIKROTIK_PASSWORD=password

```

 
## Usage

###  Mikrotik Class

Add a class of Mikrotik to your Controller

```php
use ArDigital\Mikrotik\Mikrotik;

public function getIpList(){
  $ip_list = new Mikrotik();
 return $ip_list->getIps();  // return associative array
}
etc commands:
public function firewallFilter(){
 $ip_list = new Mikrotik();
 return $ip_list->firewallFilter(); // return associative array
}
```

<img src="https://i.ibb.co/bRFnNF4/mikroitk-router-api.png">
 
