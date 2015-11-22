<?php

require __DIR__ . '/../boot/init.php';

$response = new Library\Response(new Library\View);
$router = new Library\Router($response);
$response->send($router->dispatch());
