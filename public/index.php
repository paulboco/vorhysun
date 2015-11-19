<?php

// Boot the application
require __DIR__ . '/../boot/autoloader.php';

// Get the OptedIn object
$optedIn = new Models\OptedIn;

// Fetch row where 'participant' and 'software_version' match targets
$rowByParticipant = $optedIn->getRow(array(
    array('participant', '=', 'tester'),
    array('software_version', '=', '1.1'),
));

// Fetch row by id
$rowById = $optedIn->findById(2);

// Getl all rows
$allRows = $optedIn->all();

// Include the view
include __DIR__ . '/../views/content.tpl';
