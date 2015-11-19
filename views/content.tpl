<?php include 'layout/header.tpl' ?>

<h1>Sqlsrv Class Test</h1>

<ol>
    <li>
        <p>Check for row existance by participant and software_version:</p>
        <?php if ($rowByParticipant): ?>
            <div class="result-positive">&#10004; The row exists.</div>
        <?php else: ?>
            <div class="result-negative">&#10008; The row does not exist.</div>
        <?php endif ?>
    </li>
    <li>
        <p>Fetch row by participant and software_version:</p>
        <?php if ($rowByParticipant): ?>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <?php foreach ($rowByParticipant as $key => $value): ?>
                    <tr>
                        <td><?php echo $key ?></td>
                        <td><?php echo $value ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php else: ?>
            <div class="result-negative">&#10008; Could not find that row.</div>
        <?php endif ?>
    </li>
    <li>
        <p>Fetch row by id:</p>
        <?php if ($rowById): ?>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <?php foreach ($rowById as $key => $value): ?>
                    <tr>
                        <td><?php echo $key ?></td>
                        <td><?php echo $value ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php else: ?>
            <div class="result-negative">&#10008; Could not find that row.</div>
        <?php endif ?>
    </li>
    <li>
        <p>Available Rows:</p>
        <?php if ($allRows): ?>
            <table class="all">
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
    </li>
</ol>

<?php include 'layout/footer.tpl' ?>
