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

// Fetch row by participant and software_version
$rowByParticipant = $db->getRow('opted_in', array(
    array('participant', '=', 'tester'),
    array('software_version', '=', '1.1'),
));

// Fetch row by id
$rowById = $db->getRow('opted_in', array(
    array('id', '=', 2),
));

// Include the view
include __DIR__ . '/../views/content.tpl';
