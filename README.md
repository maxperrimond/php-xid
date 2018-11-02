# Globally Unique ID Generator

> This project is a PHP implementation of the Go Lang library found here: https://github.com/rs/xid

## Install

    composer install maxperrimond/xid

## Usage

```php
<?php

use MP\XID\Factory;

$id = Factory::newXID();

echo $id; // bfe0de29jkonb71p070g
```

## Licenses

All source code is licensed under the [MIT License](LICENSE).
