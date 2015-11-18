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

?>

<!-- View the  results -->
<h1>Sqlsrv Class Test</h1>
<p><?php echo $exists ? 'The row exists.' : 'The row does not exist.'; ?></p>

<table border="1" cellpadding="7" cellspacing="0">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
<?php foreach ($row as $key => $value): ?>
    <tr>
        <th align="left"><?php echo $key ?></th>
        <td><?php echo $value ?></td>
    </tr>
<?php endforeach ?>
</table>
