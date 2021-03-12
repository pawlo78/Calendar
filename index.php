<?php

declare(strict_types=1);

namespace App;

require_once("src/Controller.php");
//testtest
$request = [
    'post' => $_POST,
    'get' => $_GET
];

(new Controller($request))->run();
