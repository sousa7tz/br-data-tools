# br-data-tools

`br-data-tools` is a lightweight PHP 8+ library for Brazilian document handling.
It provides sanitization, validation, formatting and masking for CPF and CNPJ values.

## Installation

```bash
composer require sousa7tz/br-data-tools
```

## Usage

### Sanitizer

```php
<?php

use BrDataTools\Support\Sanitizer;

echo Sanitizer::numbers('CPF: 123.456.789-00');
// 12345678900
```

### CPF

```php
<?php

use BrDataTools\Document\CPF;

$cpf = '529.982.247-25';

CPF::sanitize($cpf); // 52998224725
CPF::isValid($cpf);  // true
CPF::format($cpf);   // 529.982.247-25
```

### CNPJ

```php
<?php

use BrDataTools\Document\CNPJ;

$cnpj = '04.252.011/0001-10';

CNPJ::sanitize($cnpj); // 04252011000110
CNPJ::isValid($cnpj);  // true
CNPJ::format($cnpj);   // 04.252.011/0001-10
```

### Mask

```php
<?php

use BrDataTools\Support\Mask;

echo Mask::apply('12345678900', '###.###.###-##');
// 123.456.789-00
```

## Running tests

```bash
vendor/bin/phpunit tests
```
