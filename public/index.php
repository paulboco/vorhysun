<?php

// Boot the application
require __DIR__ . '/../boot/init.php';

// Flesh out Router.php
$router = new Library\Router;
$router->dispatch();
