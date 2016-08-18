

<div class="albumTitle hiddenElement"><?= $result['albumData'][0]['title'] ?></div>
<span id="addPhotoBtn" data-toggle="modal" data-target="#myModalPhotoAdd" class="editInfo" data-id="<?= $result['albumId'] ?>">Add New Photo</span>
<span class="backToAlbums">Back to albums</span>
            <?php
            if($result['result']): ?>
                <?php foreach($result['result'] as $elem):
                    $photo = $elem['photo']? $elem['photo'] : "undefined.jpg";
                ?>

                    <div class="photoContainer no-padding" id = "photoContainer" data-id="<?= $elem['photoId'] ?>">
                        <img src="<?= "/template/images/photo/".$photo ?>" width="189" alt="<?= $elem['title'] ?>"
                            data-id="<?= $elem['photoId'] ?>">
                    </div>
                <?php endforeach ?>
            <?php endif; ?>

            <?php if(!$result['result']): ?>
                <p> Any photo is found</p>
            <?php endif; ?>


