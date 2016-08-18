<?php
/**
 * Render personal profile and list of user's albums for logged user with possibility to edit data
 * Created by PhpStorm.
 * User: Администратор
 * Date: 04.08.2016
 * Time: 13:23
 */

?>
<div class="privateCabinetMain">
    <span id="cabinetBtn" data-toggle="modal" data-target="#myModalPrivateCabinet">Edit User Profile</span>

    <div class="userInfoMain col-xs-12 ">
       <div class="photoUserInfo col-sm-4 col-xs-12 p-a-0" id="photoUserInfo">
           <img src="/template/images/user/<?= $result['userData']['photo'] ? $result['userData']['photo']: "undefined.jpg"  ?>" alt="<?= $result['userData']['firstName'] +
           " " + $result['userData']['lastName']?>">
       </div>

        <div class="col-sm-8 col-xs-12 p-a-0">

            <table class="table">
                <tr>
                    <td class="active text-center titleUserInfo">User profile</td>
                </tr>
            </table>
            <div class="infoUserInfo col-sm-6 col-xs-12 p-a-0">
                <div class="table-responsive first">
                    <table class="table">
                        <tr>
                            <td class="active text-left">First name:</td>
                            <td class="active text-left"><?= $result['userData']['firstName'] ?></td>
                        </tr>
                        <tr>
                            <td class="active text-left">Last name:</td>
                            <td class="active text-left"><?= $result['userData']['lastName'] ?></td>
                        </tr>
                        <tr>
                            <td class="active text-left">Status:</td>
                            <td class="active text-left"><?= $result['userData']['status'] ?></td>
                        </tr>

                    </table>
                </div>
        </div>
            <div class="infoUserInfo col-sm-6 col-xs-12 p-a-0">

                <div class="table-responsive second">
                    <table class="table ">
                        <tr>
                            <td class="active text-left">DOB:</td>
                            <td class="active text-left"><?= date("F j, Y", $result['userData']['dateOfBirth'])?></td>
                        </tr>
                        <tr>
                            <td class="active text-left">Sex:</td>
                            <td class="active text-left"><?= $result['userData']['sex'] ?></td>
                        </tr>
                        <tr>
                            <td class="active text-left">Email:</td>
                            <td class="active text-left"><?= $result['userData']['email'] ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">

        <table class="table">
            <tr>
                <td class="active text-center titleUserInfo"><?= $result['userData']['firstName'] .  "'s albums"  ?></td>
            </tr>
        </table>
    </div>
    <div class="userPhotoMain clearfix">
        <span id="addAlbumBtn" user-id = "<?= $result['userData']['userId'] ?>" data-toggle="modal" data-target="#myModalAlbumAdd" class="data">Add New Album</span>

        <div class="col-xs-12 no-padding album-wrapper">
                <?php if($result['albums']): ?>
                    <?php foreach($result['albums'] as $album): ?>
                        <div class="albumInfo" data-id="<?= $album['albumId'] ?>">
                            <div class="editAlbumInfo"  >
                                <span id="deleteAlbumBtn" data-toggle="modal" data-target="#myModalAlbumDelete" data-id="<?= $album['albumId'] ?>" data-alb-name = "<?= $album['title'] ?>">Delete Album</span>
                                <span id="editAlbumInfoBtn" data-toggle="modal" data-target="#myModalAlbumEdit" data-id="<?= $album['albumId'] ?>">Edit Album Info</span>

                            </div>

                                <span class="albumName" data-id="<?= $album['albumId'] ?>"><?= $album['title'] ?></span>
                                <div class="albumPhoto">
                                    <img src="/template/images/album/<?= $album['background']? $album['background'] : "undefined.jpg" ?>" data-id="<?= $album['albumId'] ?>"
                                         class="albumPhoto">
                                </div>
                                <span class="albumDescr"><?= $album['description'] ?></span></br>
                                <span class="albumDate"> <?= "Updated: " . date("F j, Y, g:i a",$album['dateOfCreation']) ?> </span>
                        </div>
                        <?php endforeach; ?>
                <?php endif; ?>
            </div>
    </div>







</div>


