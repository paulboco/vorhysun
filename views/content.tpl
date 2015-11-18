<?php include 'header.tpl' ?>

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

<?php include 'footer.tpl' ?>
