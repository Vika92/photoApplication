<?php
    return array(
        'feedback/deleteFeedback'=>'feedback/deleteFeedback',
        'feedback/allFeedback'=>'feedback/allFeedback',
        'feedback/add'=>'feedback/add',
        'like/push'=>'like/push',
        'like/showUser'=>'like/showUser',
        'user/get'=>'user/get',
        'main' => 'index/index',
        'photo/([a-z]+)/([0-9]+)' => 'photo/$1/$2', //actionView in photoController
        'photo/view' => 'photo/view', //actionView in photoController
        'photo/viewUsers' => 'photo/viewUsers', //actionViewUsers in photoController
        'photo/delete' => 'photo/delete', //actionDelete in photoController
        'photo/add' => 'photo/add', //actionAdd in photoController
        'photo/index' => 'photo/index', //actionIndex in photoController
        'photo/getPhotoInfo' => 'photo/getPhotoInfo', //actionIndex in photoController
        'photo/edit' => 'photo/edit', //actionIndex in photoController
        'photo/indexUsers' => 'photo/indexUsers', //actionIndexUsers in photoController
        'user/getUsersByName' => 'user/getUsersByName', //actionRegister in userController
        'user/register' => 'user/register', //actionRegister in userController
        'user/login' => 'user/login', //actionRegister in userController
        'user/logout' => 'user/logout', //actionRegister in userController
        'user/uploadFile' => 'user/uploadFile', //actionUploadFile in userController
        'cabinet/userInfo' => 'cabinet/userInfo', //actionUserInfoLeftSidebar in cabinetController
        'cabinet/edit' => 'cabinet/edit', //actionEdit in cabinetController
        'cabinet/viewCabinet'=>'cabinet/viewCabinet', //actionCiewCabinet in cabinetController
        'cabinet' => 'cabinet/index', //actionIndex in cabinetController

        'album/add' => 'album/add', //actionAdd in albumController
        'album/edit' => 'album/edit', //actionEdit in albumController
        'album/getAlbumData' => 'album/getAlbumData', //actionGetAlbumData in albumController
        'album/delete' => 'album/delete', //actionDelete in albumController
        'album/albumListAll' => 'album/albumListAll', //actionAlbumListAll in albumController
        'album/index/([0-9]+)' => 'album/index/$1', //actionIndex/userId in albumController
        'album/index' => 'album/index', //actionIndex in albumController
        'index/uploadFile' => 'index/uploadFile', //actionIndex in albumController
        'index/deleteFiles' => 'index/deleteFiles', //actionIndex in albumController
        'index/viewUserInfo' => 'index/viewUserInfo', //actionViewUserInfo in indexController



    );
?>