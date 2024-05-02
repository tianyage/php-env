<?php

declare(strict_types=1);

use Tianyage\PhpEnv\EnvLoader;

require '../vendor/autoload.php';

$loader = new EnvLoader(__DIR__ . '/.env');
print_r($loader->get(''));
print_r($loader->get('TESTA') . PHP_EOL);
print_r($loader->get('TEST.TESTB') . PHP_EOL);


// 助手函数方式
echo '-------' . PHP_EOL;

print_r(env(''));
print_r(env('TESTA') . PHP_EOL);
print_r(env('TEST.TESTB') . PHP_EOL);