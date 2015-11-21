<?php include 'layout/header.tpl' ?>

<h1>Sqlsrv Class Test</h1>

<p>All Rows:</p>
<?php if ($allRows): ?>
    <table class="all" style="color: <?php echo $color ?>">
        <tr>
            <th>id</th>
            <th>participant</th>
            <th>software_version</th>
        </tr>
        <?php foreach ($allRows as $row): ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['participant'] ?></td>
                <td><?php echo $row['software_version'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
<?php else: ?>
    <div class="result-negative">&#10008; Could not find that row.</div>
<?php endif ?>

<?php include 'layout/footer.tpl' ?>
