<?php

// Boot the application
require __DIR__ . '/../boot/autoloader.php';

// Get the OptedIn object
$optedIn = new Models\OptedIn;

// Check existance of row by participant and software_version
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
