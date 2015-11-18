<?php

// Boot the application
require __DIR__ . '/../boot/load_files.php';

// Get the database object
$db = new Sqlsrv(
    Config::get('database.serverName'),
    Config::get('database.connectionInfo'
));

// Check if a row exists
$exists = $db->rowExists('opted_in', array(
    array('participant', '=', 'tester'),
    array('software_version', '=', '1.1'),
));

// Fetch the row as an array
$row = $db->getRow('opted_in', array(
    array('participant', '=', 'tester'),
    array('software_version', '=', '1.1'),
));

include __DIR__ . '/../views/content.tpl';
