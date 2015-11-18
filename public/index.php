<?php

// Boot the application
require __DIR__ . '/../boot/load_files.php';

// Get the OptedIn object
require __DIR__ . '/../models/OptedIn.php';
$optedIn = new OptedIn;

// Check if a row exists
$exists = $optedIn->rowExists(array(
    array('participant', '=', 'tester'),
    array('software_version', '=', '1.1'),
));

// Fetch row by participant and software_version
$rowByParticipant = $optedIn->getRow(array(
    array('participant', '=', 'tester'),
    array('software_version', '=', '1.1'),
));

// Fetch row by id
$rowById = $optedIn->findById(2);

// Include the view
include __DIR__ . '/../views/content.tpl';
