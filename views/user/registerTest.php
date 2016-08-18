
<?php if($result['errors']): ?>
<?php foreach ($result['errors'] as $error): ?>
<p><?= $error ?></p>

<?php endforeach ?>
<?php endif; ?>

<?php if(!$result['errors']): ?>

<p data-id="<?= $result['isRegisterd'] ?>"> <?= $result['name']  . " " . $result['surname'] . ", " . " congratulations, you are registered! " ?> </p>
<?php endif; ?>