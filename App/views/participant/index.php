<?php $this->inject('layout/header') ?>

<div class="container">
    <h1>Participants</h1>

    <p>All Rows:</p>
    <?php if ($participants): ?>
        <table class="all" style="color: <?php echo $color ?>">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
            </tr>
            <?php foreach ($participants as $row): ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    <?php else: ?>
        <div class="result-negative">&#10008; Could not find that row.</div>
    <?php endif ?>
</div>

<?php $this->inject('layout/footer') ?>
