<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 01.08.2016
 * Time: 13:51
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Photo & MyLife</title>

    <!-- normalise -->
    <link href="template/css/vendors/normalize.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap-theme.css" rel="stylesheet">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font-awesome-->
    <link href="template/css/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="template/css/css/base.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="loader hiddenElement"></div>
<div class="overlay hiddenElement"></div>
    <div class="header">
<!--       hidden div with Id of logged user-->
        <div class="hiddenElement" id ="userId"><?= $result['userId'] ?></div>

        <div class="container">
                <div class="col-sm-3 logo text-left">PHOTO <i class="fa fa-camera-retro" aria-hidden="true"></i> MYLIFE</div>
                <div class="col-sm-5 phrase no-padding">
                    <p>“A picture is a secret about a secret, the more it tells you the less you know.” <i>-Diane Arbus</i></p>
                </div>
                <div class="col-sm-4 buttons">
                    <div class="btnStyle" data-toggle="modal" data-target="#myModal" id="loginHeaderBtn">Login</div>
                    <div class="btnStyle" data-toggle="modal" data-target="#myModalRegister" id="registerHeaderBtn">Register</div>
                    <div class="btnStyle hiddenElement" id="logoutHeaderBtn">Logout</div>
                    <div class="btnStyle hiddenElement" id="cabinetHeaderBtn">Private Cabinet</div>

                </div>


        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="leftSidebar col-sm-3 col-xs-12">
                <div class="userContainer pull-right col-xs-5 col-sm-12">
                    <?php
                        $photo = $result['userId'] ?  $result['userData']['photo'] : "undefined.jpg";
                        $name = $result['userId'] ? $result['userData']['firstName'] . " " . $result['userData']['lastName'] : "Mister X";
                        $status = $result['userId'] ? $result['userData']['status'] : "Hello, dear friends, nice to meet you here!";
                    ?>
                    <div class="imgContainer">
                        <img src="/template/images/user/<?= $photo ?>" alt="<?= $name ?>" user-id="<?=  $result['userId'] ?>">
                    </div>

                        <span class="userName"><?= $name ?></span><br>
                        <h6 class="userStatus"><?= $status ?></h6>
                </div>
               <div class="allUsersContainer pull-left col-xs-7 col-sm-12">
                   <span>All users</span><br>
                   <form class="form-inline">
                           <div class="input-group">
                               <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                               <input type="text" class="form-control" id="exampleUserInput" placeholder="Find your friend">
                           </div>
                   </form>
                   <div class="usersData ">
                       <?php if($result['allUsersData']): ?>
                           <?php foreach($result['allUsersData'] as $user): ?>
                            <div class = "col-xs-12 userInfo" user-id="<?= $user['userId'] ?>">
                                <div class = "imgContainer col-xs-3">
                                    <img src="/template/images/user/<?= $user['photo'] ?>"  width="40" alt="<?= $user['firstName'] . " " . $user['lastName'] ?>">
                                </div>
                                <div class="aboutUser col-xs-9">
                                    <span class="allUsersName"><?= $user['firstName'] . " " . $user['lastName'] . ", " . $user['sex'] . ", " . $user['age'] ?></span><br>
                                    <h6 class="allUsersStatus"><?= $user['status'] ?></h6>
                                </div>

                            </div>
                           <?php endforeach; ?>
                       <?php endif; ?>
                   </div>
               </div>
            </div>
            <div class="mainContent col-sm-9 col-xs-12">


            </div>

        </div>


    </div>
    <div class="footer">
        <div class="container">
            <div class="col-sm-4 col-xs-12 logo text-left">PHOTO <i class="fa fa-camera-retro" aria-hidden="true"></i> MYLIFE</div>
            <div class="col-sm-4 col-xs-12 copyright text-center"><p>Cssauthor.com <i class="fa fa-copyright"></i> 2014 All Rights Reserved</p></div>
            <div class="col-sm-4 col-xs-12 social text-right">
                <a href="http://vk.com"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a href="https://twitter.com/"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>


    <!-- Modal Login-->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Login</h4>
                </div>

                <div class="modal-body">
                    <div class = "answer"></div>
                    <form class="form-horizontal" action="" method = "POST" name="loginform">
                        <div class="form-group">
                            <label for="loginLoginInput" class="col-sm-3 control-label">Login</label>
                            <div class="col-sm-9 loginInput" >
                                <input type="text" class="form-control inputStyle" id="loginLoginInput" name="login" value=""
                                       placeholder="Login">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passwordLoginInput" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9 passwordInput">
                                <input type="password" class="form-control" id="passwordLoginInput" name="password" value=""
                                       placeholder="Password must contain from 6 to 12 symbols, digits and letters">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer buttons">
                    <div class="btnStyle" data-dismiss="modal">Close</div>
                    <div class="btnStyle" id="logIn" >Sign in</div>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal Register -->
    <div id="myModalRegister" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Register</h4>
                </div>

                <div class="modal-body">
                    <div class = "answer"></div>
                    <form class="form-horizontal" action="" method = "POST" name="registerform">
<!--                        name-->
                        <div class="form-group">
                            <label for="nameInput" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9 nameInput" >
                                <input type="text" class="form-control inputStyle" id="nameRegisterInput" name="name" value=""
                                       placeholder="Name">
                            </div>
                        </div>
<!--                        surname-->
                        <div class="form-group">
                            <label for="surnameRegisterInput" class="col-sm-3 control-label">Surname</label>
                            <div class="col-sm-9 surnameInput" >
                                <input type="text" class="form-control inputStyle" id="surnameRegisterInput" name="surname" value=""
                                       placeholder="Surname">
                            </div>
                        </div>
<!--                        email-->
                        <div class="form-group">
                            <label for="emailRegisterInput" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9 emailInput" >
                                <input type="text" class="form-control inputStyle" id="emailRegisterInput" name="email" value=""
                                       placeholder="Email">
                            </div>
                        </div>
<!--                        dateOfBirth-->
                        <div class="form-group">
                            <label for="birthdateRegisterInput" class="col-sm-3 control-label">Date of Birth</label>
                            <div class="col-sm-9 birthdateInput">
                                <input type="text" name="birthdate" id = "birthdateRegisterInput" value="01/01/1970" />
                                <script type="text/javascript">
                                    document.addEventListener('DOMContentLoaded', function (){
                                        $('input[name="birthdate"]').daterangepicker({
                                                locale: {
                                                    format: 'YYYY-MM-DD'
                                                },
                                                singleDatePicker: true,
                                                showDropdowns: true
                                            },
                                            function(start, end, label) {

                                            });
                                    });
                                </script>
                            </div>
                        </div>
<!--                        document.getElementById("birthdateRegisterInput").value-->

<!--                        sex-->
                        <div class="form-group">
                            <label for="sexRegisterInput" class="col-sm-3 control-label">Sex</label>
                            <div class="col-sm-9 sexInput">
                                <select class="form-control" id="sexRegisterInput" name="sex">
                                    <option>male</option>
                                    <option>female</option>
                                </select>
                            </div>
                        </div>
<!--                        document.getElementById("sexRegisterInput").value-->
<!--                        status-->
                        <div class="form-group">
                            <label for="statusRegisterInput" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9 statusInput" >
                                <input type="text" class="form-control inputStyle" id="statusRegisterInput" name="status" value=""
                                       placeholder="Status">
                            </div>
                        </div>
<!--                        upload photo-->
                        <div class="form-group">
                            <label for="fileRegisterInput" class="col-sm-3 control-label">Photo</label>
                            <div class="col-sm-9 fileRegisterBlock">
                                <div class="file_upload">
                                    <div><button type="button" class="fileBtnStyle" id ="fileRegisterInput" name="filename">Upload File</button></div>
                                    <div><i>File is not choosen</i></div>
                                    <input type="file" name="filename" id ="fileRegisterInput">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="loginRegisterInput" class="col-sm-3 control-label">Login</label>
                            <div class="col-sm-9 loginInput" >
                                <input type="text" class="form-control inputStyle" id="loginRegisterInput" name="login" value=""
                                       placeholder="Login">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passwordRegisterInput" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9 passwordInput">
                                <input type="password" class="form-control" id="passwordRegisterInput" name="password" value=""
                                       placeholder="Password must contain from 6 to 12 symbols, digits and letters">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer buttons">
                    <div class="btnStyle" id="closeInRegister" data-dismiss="modal">Close</div>
                    <div class="btnStyle register" id="register" >Register</div>
                    <div class="btnStyle hiddenElement" id="loginInRegister">Login</div>

                </div>
            </div>
        </div>
    </div>

    <!--            Edit user's info -->
    <div id="myModalPrivateCabinet" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Private Cabinet</h4>
                </div>

                <div class="modal-body">
                    <div class = "answer"></div>
                    <form class="form-horizontal" action="" method = "POST" name="privateCabinetform">
                        <!--                        name-->
                        <div class="form-group">
                            <label for="nameCabinetInput" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9 nameInput" >
                                <input type="text" class="form-control inputStyle" id="nameCabinetInput" name="name" value="<?= $result['userData']['firstName'] ?>"
                                       placeholder="Name">
                            </div>
                        </div>
                        <!--                        surname-->
                        <div class="form-group">
                            <label for="surnameCabinetInput" class="col-sm-3 control-label">Surname</label>
                            <div class="col-sm-9 surnameInput" >
                                <input type="text" class="form-control inputStyle" id="surnameCabinetInput" name="surname" value="<?= $result['userData']['lastName'] ?>"
                                       placeholder="Surname">
                            </div>
                        </div>
                        <!--                        email-->
                        <div class="form-group">
                            <label for="emailCabinetInput" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9 emailInput" >
                                <input type="text" class="form-control inputStyle" id="emailCabinetInput" name="email" value="<?= $result['userData']['email'] ?>"
                                       placeholder="Email">
                            </div>
                        </div>
                        <!--                        dateOfBirth-->
                        <div class="form-group">
                            <label for="birthdateCabinetInput" class="col-sm-3 control-label">Date of Birth</label>
                            <div class="col-sm-9 birthdateInput">
                                <input type="text" name="birthdate" id = "birthdateCabinetInput" value="<?=
                                $result['userData']['dateOfBirthUp']['year'] . '/' . $result['userData']['dateOfBirthUp']['month'] . '/' . $result['userData']['dateOfBirthUp']['date']?>" />
                                <script type="text/javascript">
                                    document.addEventListener('DOMContentLoaded', function (){
                                        $('input[name="birthdate"]').daterangepicker({
                                                locale: {
                                                    format: 'YYYY-MM-DD'
                                                },
                                                singleDatePicker: true,
                                                showDropdowns: true
                                            },
                                            function(start, end, label) {

                                            });
                                    });
                                </script>
                            </div>
                        </div>
                        <!--                        document.getElementById("birthdateRegisterInput").value-->

                        <!--                        sex-->
                        <div class="form-group">
                            <label for="sexCabinetInput" class="col-sm-3 control-label">Sex</label>
                            <div class="col-sm-9 sexInput">
                                <select class="form-control" id="sexCabinetInput" name="sex" data-sex="<?= $result['userData']['sex'] ?>" value="">
                                    <option>male</option>
                                    <option>female</option>
                                </select>
                            </div>
                        </div>
                        <!--                        document.getElementById("sexRegisterInput").value-->
                        <!--                        status-->
                        <div class="form-group">
                            <label for="statusCabinetInput" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9 statusInput" >
                                <input type="text" class="form-control inputStyle" id="statusCabinetInput" name="status" value="<?= $result['userData']['status'] ?>"
                                       placeholder="Status">
                            </div>
                        </div>
                        <!--                        upload photo-->
                        <div class="form-group">
                            <label for="fileCabinetInput" class="col-sm-3 control-label fileCabinetInput">Photo</label>
                            <div class="photoButton">
                                <div class="photo">
                                    <img src="/template/images/user/<?= $result['userData']['photo'] ?>"  width="180" alt="<?= $result['userData']['firstName'] . " " . $result['userData']['lastName'] ?>">
                                </div>
                                <div class="fileCabinetBlock">
                                    <div class="file_upload">
                                        <div class="fileBtn"><button type="button" class="fileBtnStyle" id ="fileCabinetInput" name="filename">Upload File</button></div>
                                        <div class="fileName"><i>File is not choosen</i></div>
                                        <input type="file" name="filename" id ="fileCabinetInput">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="loginCabinetInput" class="col-sm-3 control-label">Login</label>
                            <div class="col-sm-9 loginInput" >
                                <input type="text" class="form-control inputStyle" id="loginCabinetInput" name="login" value="<?= $result['userData']['login'] ?>"
                                       placeholder="Login">
                            </div>
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="passwordCabinetInput" class="col-sm-3 control-label">Password</label>-->
<!--                            <div class="col-sm-9 passwordInput">-->
<!--                                <input type="password" class="form-control" id="passwordCabinetInput" name="password" value="--><?//= $result['userData']['passwordBackUp'] ?><!--"-->
<!--                                       placeholder="Password must contain from 6 to 12 symbols, digits and letters">-->
<!--                            </div>-->
<!--                        </div>-->

                    </form>
                </div>
                <div class="modal-footer buttons">
                    <div class="btnStyle" id="closeInCabinet" data-dismiss="modal">Close</div>
                    <div class="btnStyle register" id="editCabinet" >Update</div>
                    <!--                    <div class="btnStyle register" id="editCabinetAgain" >Edit again</div>-->


                </div>
            </div>
        </div>
    </div><!--     End       Edit user's info -->

    <!--            Edit user's  album info -->
    <div id="myModalAlbumEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--    insert content here  -->
            </div>
        </div>
    </div><!--     End       Edit user's album info -->
    <!--            Add user's  album info -->
    <div id="myModalAlbumAdd" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add new album</h4>
                </div>
                <div class="modal-body">
                    <div class = "answer"></div>
                    <form class="form-horizontal" action="" method = "POST" name="albumAddform">
                        <!--                        title-->
                        <div class="form-group">
                            <label for="albumTitleInput" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9 titleInput" >
                                <input type="text" class="form-control inputStyle" id="albumTitleInput" name="title" value=""
                                       placeholder="Title">
                            </div>
                        </div>
                        <!--                        description-->
                        <div class="form-group">
                            <label for="albumDescriptionInput" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9 descriptionInput" >
                                <input type="text" class="form-control inputStyle" id="albumDescriptionInput" name="description" value=""
                                       placeholder="Description">
                            </div>
                        </div>

                        <!--                        upload photo-->
                        <div class="form-group">
                            <div class="nameOfUpploadedFile hiddenElement"></div>
                            <label for="fileCabinetInput" class="col-sm-3 control-label fileCabinetInput">Photo</label>
                            <div class="photoButton">
                                <div class="photo">
                                    <img src="/template/images/album/undefined.jpg"  width="180" alt="">
                                </div>
                                <div class="fileAlbumBlock">
                                    <div class="file_upload">
                                        <div class="fileBtn"><button type="button" class="fileBtnStyle" name="filename">Upload File</button></div>
                                        <div class="fileName"><i>File is not choosen</i></div>
                                        <input type="file" name="filename" id ="fileAddAlbumInput">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer buttons">
                    <div class="btnStyle" id="closeAlbumAdd" data-dismiss="modal">Close</div>
                    <div class="btnStyle" id="addAlbum" data-id="">Add</div>
                </div>
            </div>
        </div>
    </div><!--     End       Edit user's album info -->

    <!--   Delete album info -->
    <div id="myModalAlbumDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Are you sure, you want to delete album <span></span></h4>
                </div>

                <div class="modal-footer buttons">

                    <div class="btnStyle register" id="closeDelete" data-dismiss="modal">No</div>
                    <div class="btnStyle" id="deleteAlbumFinalBtn" >Yes</div>

                </div>
            </div>
        </div>
    </div><!--     End       Delete album info -->

    <!--            Add user's  photo info -->
    <div id="myModalPhotoAdd" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add new photo</h4>
                </div>
                <div class="modal-body">
                    <div class = "answer"></div>
                    <form class="form-horizontal" action="" method = "POST" name="photoAddform">
                        <!--                        title-->
                        <div class="form-group">
                            <label for="photoTitleInput" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9 titleInput" >
                                <input type="text" class="form-control inputStyle" id="photoTitleInput" name="title" value=""
                                       placeholder="Title">
                            </div>
                        </div>
                        <!--                        description-->
                        <div class="form-group">
                            <label for="photoDescriptionInput" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9 descriptionInput" >
                                <input type="text" class="form-control inputStyle" id="photoDescriptionInput" name="description" value=""
                                       placeholder="Description">
                            </div>
                        </div>

                        <!--                        upload photo-->
                        <div class="form-group">
                            <div class="nameOfUpploadedFile hiddenElement"></div>
                            <label for="fileCabinetInput" class="col-sm-3 control-label fileCabinetInput">Photo</label>
                            <div class="photoButton">
                                <div class="photo">
                                    <img src="/template/images/album/undefined.jpg"  width="180" alt="">
                                </div>
                                <div class="fileAlbumBlock">
                                    <div class="file_upload">
                                        <div class="fileBtn"><button type="button" class="fileBtnStyle" name="filename">Upload File</button></div>
                                        <div class="fileName"><i>File is not choosen</i></div>
                                        <input type="file" name="filename" id ="fileAddPhotoInput">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer buttons">
                    <div class="btnStyle" id="closePhotoAdd" data-dismiss="modal">Close</div>
                    <div class="btnStyle" id="addPhoto" data-id="">Add</div>
                </div>
            </div>
        </div>
    </div><!--            End user's  photo info -->
<!-- popup for images -->
    <div class="b-popup hiddenElement">
        <div class="b-popup-content">
            Text in Popup
        </div>
    </div>
    <!--   Delete photo info -->
    <div id="myModalPhotoDelete" style="position:absolute; z-index:20;" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Are you sure, you want to delete this photo?</h4>
                </div>

                <div class="modal-footer buttons">

                    <div class="btnStyle register closeDeletePhoto" id="closeDelete" data-dismiss="modal">No</div>
                    <div class="btnStyle" id="deletePhotoFinalBtn" >Yes</div>

                </div>
            </div>
        </div>
    </div><!--     End       Delete photo info -->
    <!--            Edit photo info -->
    <div id="myModalPhotoEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--    insert content here  -->
            </div>
        </div>
    </div><!--     End       Edit photo info -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/template/javaScript/index/index.js"></script


<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />


<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

</body>
</html>