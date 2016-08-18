<?php
/**
 * Render text if profile is updated
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.08.2016
 * Time: 22:28
 */
//print_r($result);
?>

<?php if($result['errors']): ?>
<?php foreach ($result['errors'] as $error): ?>
<p><?= $error ?></p>

<?php endforeach ?>
<?php endif; ?>

<?php if(!$result['errors']): ?>

<p data-id="<?= $result['isUpdated'] ?>"> <?= $result['name']  . " " . $result['surname'] . ", " . " congratulations, your profile ia updated! " ?> </p>
<?php endif; ?>