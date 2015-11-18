<?php include 'header.tpl' ?>

<main class="container">
    <div class="row">
        <div class="col of-8">
            <h1>Sqlsrv Class Test</h1>

            <h2>Check for row existance</h2>
            <p><?php echo $exists ? 'The row exists.' : 'The row does not exist.'; ?></p>

            <h2>Fetch row by participant and software version</h2>
                <table class="tbl alternate center narrow silver">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rowByParticipant as $key => $value): ?>
                            <tr>
                                <th align="left"><?php echo $key ?></th>
                                <td><?php echo $value ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <h2>Fetch row by id</h2>
                <table border="1" cellpadding="7" cellspacing="0">
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    <?php foreach ($rowById as $key => $value): ?>
                        <tr>
                            <th align="left"><?php echo $key ?></th>
                            <td><?php echo $value ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
</main>

<?php include 'footer.tpl' ?>
