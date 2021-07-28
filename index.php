<?php
require __DIR__ . '/vendor/autoload.php';

use App\controller\FizzBuzz;

$fizz = new FizzBuzz();

for ($i = 1; $i <= 15; $i++) {
    var_dump($fizz->convert($i));
}
