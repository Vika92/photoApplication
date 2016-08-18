<div class="albumTitle hiddenElement"><?= $result['albumData'][0]['title'] ?></div>
<span class="backToAlbums" user-id="<?= $result['albumData'][0]['userId'] ?>">Back to albums</span>
            <?php
            if($result['result']): ?>
                <?php foreach($result['result'] as $elem):
                    $photo = $elem['photo']? $elem['photo'] : "undefined.jpg";
                ?>
                    <div class="photoContainer no-padding" id = "photoContainer" data-id="<?= $elem['photoId'] ?>">
                        <img src="<?= "/template/images/photo/".$photo ?>" width="189" alt="<?= $elem['title'] ?>"
                            data-id="<?= $elem['photoId'] ?>" user-id="<?= $result['albumData'][0]['userId'] ?>">
                    </div>
                <?php endforeach ?>
            <?php endif; ?>

            <?php if(!$result['result']): ?>
                <p> Any photo is found in this album</p>
            <?php endif; ?>


