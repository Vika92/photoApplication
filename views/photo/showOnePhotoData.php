<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.08.2016
 * Time: 15:23
 */

?>

<!--            Edit photo info -->

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit photo Info</h4>
                </div>
                <div class="modal-body">
                    <div class = "answer"></div>
                    <form class="form-horizontal" action="" method = "POST" name="photoInfoform">
                        <!--                        title-->
                        <div class="form-group">
                            <label for="photoTitleInput" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9 titleInput" >
                                <input type="text" class="form-control inputStyle" id="photoEditTitleInput" name="title" value="<?= $result['photo'][0]['title'] ?>"
                                       placeholder="Tile">
                            </div>
                        </div>
                        <!--                        description-->
                        <div class="form-group">
                            <label for="photoDescriptionInput" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9 descriptionInput" >
                                <input type="text" class="form-control inputStyle" id="photoEditDescriptionInput" name="description" value="<?= $result['photo'][0]['description']?>"
                                       placeholder="Description">
                            </div>
                        </div>

                        <!--                        upload photo-->
                        <div class="form-group">
                            <div class="nameOfUpploadedFile hiddenElement"></div>
                            <label for="fileCabinetInput" class="col-sm-3 control-label fileCabinetInput">Photo</label>
                            <div class="photoButton">
                                <div class="photo">
                                    <img src="/template/images/photo/<?= $result['photo'][0]['photo'] ?>"  width="180" alt="<?= $result['photo'][0]['title']?>">
                                </div>
                                <div class="filePhotoEditBlock">
                                    <div class="file_upload">
                                        <div class="fileBtn"><button type="button" class="fileBtnStyle" name="filename">Upload File</button></div>
                                        <div class="fileName"><i>File is not chosen</i></div>
                                        <input type="file" name="filename" id ="filePhotoEditInput">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--                        description-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Last Update</label>
                            <div class="col-sm-9 photoDate" >
                                <span class=""> <?= date("F j, Y, g:i a",$result['photo'][0]['dateOfCreation']) ?> </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer buttons">
                    <div class="btnStyle" id="closePhotoEdit" data-dismiss="modal">Close</div>
                    <div class="btnStyle" id="editPhoto" data-id="<?=$result['photo'][0]['photoId'] ?>"
                         album-id="<?=$result['photo'][0]['albumId'] ?>">Edit</div>
                </div>
