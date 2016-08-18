<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.08.2016
 * Time: 15:23
 */

?>

<!--            Edit user's album info -->

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit album info</h4>
                </div>
                <div class="modal-body">
                    <div class = "answer"></div>
                    <form class="form-horizontal" action="" method = "POST" name="albumInfoform">
                        <!--                        title-->
                        <div class="form-group">
                            <label for="albumTitleInput" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9 titleInput" >
                                <input type="text" class="form-control inputStyle" id="albumTitleInput" name="title" value="<?= $result['album']['title'] ?>"
                                       placeholder="Tile">
                            </div>
                        </div>
                        <!--                        description-->
                        <div class="form-group">
                            <label for="albumDescriptionInput" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9 descriptionInput" >
                                <input type="text" class="form-control inputStyle" id="albumDescriptionInput" name="description" value="<?= $result['album']['description']?>"
                                       placeholder="Description">
                            </div>
                        </div>

                        <!--                        upload photo-->
                        <div class="form-group">
                            <div class="nameOfUpploadedFile hiddenElement"></div>
                            <label for="fileCabinetInput" class="col-sm-3 control-label fileCabinetInput">Photo</label>
                            <div class="photoButton">
                                <div class="photo">
                                    <img src="/template/images/album/<?= $result['album']['background'] ?>"  width="180" alt="<?= $result['album']['title']?>">
                                </div>
                                <div class="fileAlbumBlock">
                                    <div class="file_upload">
                                        <div class="fileBtn"><button type="button" class="fileBtnStyle" name="filename">Upload File</button></div>
                                        <div class="fileName"><i>File is not chosen</i></div>
                                        <input type="file" name="filename" id ="fileAlbumInput">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--                        description-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Last Update</label>
                            <div class="col-sm-9 albumDate" >
                                <span class=""> <?= date("F j, Y, g:i a",$result['album']['dateOfCreation']) ?> </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer buttons">
                    <div class="btnStyle" id="closeAlbumEdit" data-dismiss="modal">Close</div>
                    <div class="btnStyle" id="editAlbum" data-id="<?=$result['album']['albumId'] ?>">Edit</div>
                </div>
