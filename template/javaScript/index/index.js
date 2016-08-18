/**
 * 1. Initializing all variables (line 44)
 * 2. Event handlers for "Edit album info" container (line 79)
 * 3. Event handlers for "Delete Album" container (line 155)
 * 4. Event handlers for "Add Album" container (line 173)
 * 5. Event handlers for click on album container, display photos (line 254)
 * 6. Event handlers for “Add New Photo” container (line 264)
 * 7. Event handlers for click on photo container, display photo info (line 315)
 * 8. Event handlers for feedback container (line 322)
 * 9. Event handlers for click on “Like” container (line 413)
 *10. Event handler for cross in Photo container to close it(line 434)
 *11. Event handlers for “Delete photo” container (line 442)
 *12. Event handlers for “Edit photo” container (line 486)
 *13. Event handlers for arrows in “Photo” container to show other photo (line 560)
 *14. Event handler for “Back to albums” (line 579)
 *15. Event handler for click on top image in left SideBar to open user’s page  (line 588)
 *16. Event handler for click on User in Left Sidebar to see user's data (line 593)
 *17. Event handler for “Edit User Profile” container (line 600)
 *18. Event handler for "Login" button (line 609)
 *19. Event handler for "Logout" button (line 670)
 *20. Event handler for "Register" container (line 690)
 *21. Event handler for “Update” in "Edit User Profile" container (line 774)
 *22. Event handlers for “Private cabinet” (line 830)
 *23. Event handler for filter users in left sidebar(line 835)
 *24. Event handler for scrolling users to the bottom of the page in left Sidebar (line 862)
 *25. Event handlers on change contents of uploaded file in form (line 890)
 *26. Event handlers mouseover and mouseout events on “Like” container to show and hide like authors (line 1035)
 *27. Function to perform pagination of photos when click on right and left arrows in “Photo container” (line 1056)
 *28. Function to update user cabinet (line 1106)
 *39. Function to update user’s info in left Sidebar (line 1125)
 *30. Function to update photos in album (line 1146)
 *31. Function to show users info by userId (line 1190)
 *32. Function to update photo in "Photo" container (line 1213)
 *33. Function to show like authors (line 1260)
 *34. Function to show/hide feedbacks (line 1288)
 *35. Time Interval to change sentence in header (line 1316)
 *36. Function to calculate random integer between min and max values (line 1351)
 *37. Function to get instance of object XMLHttpRequest (line 1364)
 *37. Function to delete or add class to element (line 1385)
 *38. Function to change header buttons (line 1409)
 *39. Functions for input form validation (line 1356)

 */
document.addEventListener('DOMContentLoaded', function (){
    var loginHeaderBtn = document.getElementById("loginHeaderBtn"),
        registerHeaderBtn =  document.getElementById("registerHeaderBtn"),
        logout = document.getElementById("logoutHeaderBtn"),
        loginInside = document.getElementById("loginInRegister"),
        cabinetHeaderBtn = document.getElementById("cabinetHeaderBtn"),
        editCabinet = document.getElementById("editCabinet"),
        editCabinetAgain = document.getElementById("editCabinetAgain"),
        closeInCabinet = document.getElementById("closeInCabinet"),
        cabinetBtn = document.getElementById("cabinetBtn"),
        mainContent = document.getElementsByClassName("mainContent")[0],
        photoProfSidebar = document.querySelectorAll(".userContainer .imgContainer img")[0],
        albumsEditBtn =  document.querySelectorAll(".editAlbumInfo span"),
        editAlbumInfoBtn = document.querySelectorAll("#editAlbumInfoBtn"),
        editInAlbum = document.querySelectorAll("#editAlbum")[0],
        photoInCabinet = document.querySelectorAll(".photoUserInfo img")[0],
        closeAlbumEdit = document.querySelectorAll("#closeAlbumEdit")[0],
        users = document.querySelectorAll(".usersData .col-xs-12"),
        userId = document.getElementById("userId").innerText,
        body = document.getElementsByTagName("body"),
        overlay = document.querySelectorAll(".overlay")[0],
        loader = document.querySelectorAll(".loader")[0];

    //Display user's page if it is logged in and the page of user with userId = 1, if user is not logged in;
    //Change visible buttons in header
    if(userId){
       seeUserInfo(userId) ;
        changeHeaderButtons(true);
    }else{
        seeUserInfo(1);
    }

    $(document).on('click',body, function(event){

        var targ = event.target;

        //click on button Edit Album Info in Private Cabinet
        if(targ.getAttribute("id") == "editAlbumInfoBtn"){
            var  albumId = targ.getAttribute("data-id"),
               xmlhttp = getXmlHttp();
            xmlhttp.open('POST', '/album/getAlbumData/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var html = xmlhttp.responseText;
                        var container= document.querySelectorAll("#myModalAlbumEdit .modal-content")[0];
                        container.innerHTML= "";
                        container.innerHTML = html;
                    }
                }
            };
            var data = new FormData();
            data.append('albumId', albumId);
            xmlhttp.send(data);
        }

        //click on Edit button in Edit Album
        if(targ.getAttribute("id") == "editAlbum"){
            var  albumId = targ.getAttribute("data-id"),
                albumTitle = document.querySelectorAll('#albumTitleInput')[0].value,
                albumDescription = document.querySelectorAll('#albumDescriptionInput')[0].value,
                albumPhoto = document.getElementById("fileAlbumInput").files[0],
                xmlhttp = getXmlHttp();
            var photoName = "";

            if(albumPhoto){
                photoName = albumPhoto['name'];
            }else{
                albumPhoto = "";
            }
                validate(albumInfoform, 0);

            if(document.getElementsByClassName('error-message').length !== 0){
                event.preventDefault();

            }else{

                //ajax to edit in db
                xmlhttp.open('POST', '/album/edit/', true);

                xmlhttp.onreadystatechange = function () {

                    if (xmlhttp.readyState == 4) {
                        if (xmlhttp.status == 200) {

                            //update user profile Data
                            updateUserCabinet();
                            albumInfoform.setAttribute("class", modifyClassList(albumInfoform.getAttribute("class"),"add","hiddenElement"));

                            var editInAlbum = $(document).find("#editAlbum")[0];
                            editInAlbum.setAttribute("class", modifyClassList(editInAlbum.getAttribute("class"),"add","hiddenElement"));
                            var closeAlbumEdit = $(document).find("#closeAlbumEdit")[0];

                            closeAlbumEdit.setAttribute("class", modifyClassList(closeAlbumEdit.getAttribute("class"),"add","hiddenElement"));
                            var answerContainer= $(document).find("#myModalAlbumEdit .answer")[0];
                            answerContainer.innerHTML = "Congratulations, album " + albumTitle + " is updated!";

                        }
                    }
                }

                var data = new FormData();
                data.append('title', albumTitle);
                data.append('description', albumDescription);
                data.append('albumId', albumId);
                data.append('photo', albumPhoto);
                data.append('photoName', photoName);
                data.append('directory', 'album');
                xmlhttp.send(data);
            }
        }

        //click on delete Album above the album container
        if(targ.getAttribute("id") == "deleteAlbumBtn"){
            var  albumId = targ.getAttribute("data-id"),
                 albumName = targ.getAttribute("data-alb-name"),
                 buttonYes = document.getElementById("deleteAlbumFinalBtn"),
                 buttonNo = document.getElementById("closeDelete"),
                 textContainer = document.querySelectorAll("#myModalAlbumDelete h4")[0];

            buttonYes.setAttribute("class", modifyClassList(buttonYes.getAttribute("class"),"delete","hiddenElement"));
            buttonNo.setAttribute("class", modifyClassList(buttonNo.getAttribute("class"),"delete","hiddenElement"));

            textContainer.innerHTML = "Are you sure, you want to delete album " + albumName + "?";

            buttonYes.setAttribute("data-id",albumId);

            buttonYes.setAttribute("data-alb-name",albumName);

        }
        //click on button YES in delete album Container
        if(targ.getAttribute("id") == "deleteAlbumFinalBtn"){
            var  albumId = targ.getAttribute("data-id"),
                 albumName = targ.getAttribute("data-alb-name"),
                 xmlhttp = getXmlHttp();

            xmlhttp.open('POST', '/album/delete/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var textContainer = document.querySelectorAll("#myModalAlbumDelete h4")[0];
                        textContainer.innerHTML = "Congratulations, album " + albumName + " was successfully deleted!";
                        var buttonYes = document.getElementById("deleteAlbumFinalBtn"),
                            buttonNo = document.getElementById("closeDelete");
                        buttonYes.setAttribute("class", modifyClassList(buttonYes.getAttribute("class"),"add","hiddenElement"));
                        buttonNo.setAttribute("class", modifyClassList(buttonNo.getAttribute("class"),"add","hiddenElement"));
                        updateUserCabinet();

                    }
                }
            };
            var data = new FormData();
            data.append('albumId', albumId);
            xmlhttp.send(data);
        }

        //click on Add New Album
        if(targ.getAttribute("id") == "addAlbumBtn") {

            var buttonAdd = document.getElementById("addAlbum"),
                buttonNo = document.getElementById("closeAlbumAdd"),
                textContainer = document.querySelectorAll("#myModalAlbumAdd .answer")[0],
                userId = document.querySelectorAll("#addAlbumBtn")[0].getAttribute("user-id");
            buttonAdd.setAttribute("user-id",userId);
            textContainer.innerHTML = "";
            buttonAdd.setAttribute("class", modifyClassList(buttonAdd.getAttribute("class"),"delete","hiddenElement"));
            buttonNo.setAttribute("class", modifyClassList(buttonNo.getAttribute("class"),"delete","hiddenElement"));
            albumAddform.setAttribute("class", modifyClassList(albumAddform.getAttribute("class"),"delete","hiddenElement"));
            cleanForm(albumAddform);
            cleanFileInput(albumAddform, 2, "album");
        }

        //click on button Add in Add album Container
        if(targ.getAttribute("id") == "addAlbum") {
            var xmlhttp = getXmlHttp(),
                data = new FormData(),
                title = document.querySelectorAll("#myModalAlbumAdd #albumTitleInput")[0].value,
                description = document.querySelectorAll("#myModalAlbumAdd #albumDescriptionInput")[0].value,
                photo = document.querySelectorAll("#fileAddAlbumInput")[0].files[0];

            validate(albumAddform, 1);
            if (document.getElementsByClassName('error-message').length !== 0) {
                event.preventDefault();

            } else {

                xmlhttp.open('POST', '/album/add/', true);
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4) {
                        if (xmlhttp.status == 200) {
                            var textContainer = document.querySelectorAll("#myModalAlbumAdd .answer")[0],
                                html = xmlhttp.responseText;
                            textContainer.innerHTML = html;
                            var buttonAdd = document.getElementById("addAlbum"),
                                buttonNo = document.getElementById("closeAlbumAdd");
                            buttonAdd.setAttribute("class", modifyClassList(buttonAdd.getAttribute("class"),"add","hiddenElement"));
                            buttonNo.setAttribute("class", modifyClassList(buttonNo.getAttribute("class"),"add","hiddenElement"));
                            albumAddform.setAttribute("class", modifyClassList(albumAddform.getAttribute("class"),"add","hiddenElement"));
                            updateUserCabinet();

                        }
                    }
                };
                data.append('title', title);
                data.append('description', description);
                data.append('photo', photo);
                xmlhttp.send(data);
            }
        }

        //click on Album photo or title to display photos in album
        if((event.target.getAttribute("class") == "albumName") || ((event.target.getAttribute("class") == "albumPhoto") && event.target.tagName == "IMG")) {
            var albumId = event.target.getAttribute("data-id"),
                userId = event.target.getAttribute("user-id"),
                albumTitle = event.target.getAttribute("data-id");

                updatePhotos(albumId, userId);

        }

        //click on "Add New Photo"
        if(targ.getAttribute("id") == "addPhotoBtn") {
            var buttonAdd = document.getElementById("addPhoto"),
                albumId = targ.getAttribute("data-id"),
                buttonAdd = document.getElementById("addPhoto"),
                buttonNo = document.getElementById("closePhotoAdd"),
                textContainer = document.querySelectorAll("#myModalPhotoAdd .answer")[0];
            buttonAdd.setAttribute("data-id", albumId);
            buttonAdd.setAttribute("class", modifyClassList(buttonAdd.getAttribute("class"), "delete", "hiddenElement"));
            buttonNo.setAttribute("class", modifyClassList(buttonNo.getAttribute("class"), "delete", "hiddenElement"));
            photoAddform.setAttribute("class", modifyClassList(photoAddform.getAttribute("class"), "delete", "hiddenElement"));
            textContainer.innerHTML = "";
            cleanForm(photoAddform);
            cleanFileInput(photoAddform, 3, "photo")
        }
        //click on "Add" in "Add new photo" container
        if(targ.getAttribute("id") == "addPhoto") {
            var xmlhttp = getXmlHttp(),
                data = new FormData(),
                title = document.querySelectorAll("#myModalPhotoAdd #photoTitleInput")[0].value,
                description = document.querySelectorAll("#myModalPhotoAdd #photoDescriptionInput")[0].value,
                photo = document.querySelectorAll("#fileAddPhotoInput")[0].files[0],
                albumId = targ.getAttribute("data-id");

            validate(photoAddform, 2);
            if (document.getElementsByClassName('error-message').length !== 0) {
                event.preventDefault();
            } else {
                xmlhttp.open('POST', '/photo/add/', true);
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4) {
                        if (xmlhttp.status == 200) {
                            var textContainer = document.querySelectorAll("#myModalPhotoAdd .answer")[0],
                                buttonAdd = document.getElementById("addPhoto"),
                                buttonNo = document.getElementById("closePhotoAdd"),
                                html = xmlhttp.responseText;
                            textContainer.innerHTML = html;
                            buttonAdd.setAttribute("class", modifyClassList(buttonAdd.getAttribute("class"), "add", "hiddenElement"));
                            buttonNo.setAttribute("class", modifyClassList(buttonNo.getAttribute("class"), "add", "hiddenElement"));
                            photoAddform.setAttribute("class", modifyClassList(albumAddform.getAttribute("class"), "add", "hiddenElement"));
                            updatePhotos(albumId);
                        }
                    }
                };
                data.append('title', title);
                data.append('description', description);
                data.append('albumId', albumId);
                data.append('photo', photo);
                xmlhttp.send(data);
            }
        }
        //click on photo to display photo info
        if(targ.parentElement.getAttribute("id") == "photoContainer") {

            var photoId = targ.getAttribute("data-id"),
                userId = targ.getAttribute("user-id");
            updatePhotoInfo(photoId,userId);
        }
        //click on "Show all" in feedback container
        if(targ.getAttribute("class") == "allFeedbacks"){
            var photoId = targ.getAttribute("data-id");

            showFeedback(photoId, 0, "");
            setTimeout(function() {
                var hideBtn = document.getElementsByClassName("hideFeedbacks")[0],
                    showAllBtn = document.getElementsByClassName("allFeedbacks")[0],
                    showMoreBtn = document.getElementsByClassName("moreFeedbacks")[0];
                hideBtn.setAttribute("class", modifyClassList(hideBtn.getAttribute("class"), "delete", "hiddenElement"));
                showAllBtn.setAttribute("class", modifyClassList(showAllBtn.getAttribute("class"), "add", "hiddenElement"));
                showMoreBtn.setAttribute("class", modifyClassList(showMoreBtn.getAttribute("class"), "add", "hiddenElement"));

            }, 100);
        }
        //click on "Hide" in feedback container
        if(targ.getAttribute("class") == "hideFeedbacks "){
            var photoId = targ.getAttribute("data-id");
            showFeedback(photoId, 0, 3);

        }
        //click on "Show more" in feedback container
        if(targ.getAttribute("class") == "moreFeedbacks") {
            var limit = document.getElementsByClassName("feedback").length + 3,
                photoId = targ.getAttribute("data-id");

            showFeedback(photoId, 0, limit);
            setTimeout(function () {
                var hideBtn = document.getElementsByClassName("hideFeedbacks")[0],
                    showAllBtn = document.getElementsByClassName("allFeedbacks")[0],
                    showMoreBtn = document.getElementsByClassName("moreFeedbacks")[0],
                    feedbackQuantity = document.getElementsByClassName("feedback").length;
                if(feedbackQuantity<=limit){
                    showAllBtn.setAttribute("class", modifyClassList(showAllBtn.getAttribute("class"), "add", "hiddenElement"));
                    showMoreBtn.setAttribute("class", modifyClassList(showMoreBtn.getAttribute("class"), "add", "hiddenElement"));
                }
                hideBtn.setAttribute("class", modifyClassList(hideBtn.getAttribute("class"), "delete", "hiddenElement"));

            }, 100);
        }
        //click on "Delete" in feedback container
        if(targ.getAttribute("id") == "deleteFeedback"){

            var feedbackId = targ.getAttribute("feedback-id"),
                photoId = targ.getAttribute("photo-id"),
                xmlhttp = getXmlHttp(),
                data = new FormData(),
                feedbackQuantity = document.getElementsByClassName("feedback").length;
            xmlhttp.open('POST', '/feedback/deleteFeedback/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {

                        showFeedback(photoId, 0, feedbackQuantity);
                    }
                }
            }
            data.append('feedbackId', feedbackId);
            xmlhttp.send(data);
        }

        //click on "Add" in feedback container
        if(targ.getAttribute("id") == "addFeedback"){
            var feedbackText = document.querySelectorAll("input#feedback")[0].value,
                errorContainer = document.querySelectorAll(".writeFeedback .error")[0],
                photoId = targ.getAttribute("photo-id"),
                xmlhttp = getXmlHttp(),
                data = new FormData(),
                feedbackQuantity = document.getElementsByClassName("feedback").length;


            if(feedbackText == ""){
                errorContainer.innerHTML = "Feedback field is empty, please fill it!";
            }else{
                xmlhttp.open('POST', '/feedback/add/', true);
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4) {
                        if (xmlhttp.status == 200) {
                            var html = xmlhttp.responseText;
                            errorContainer.innerHTML = html;
                            showFeedback(photoId, 0, feedbackQuantity);
                            feedbackText.value="";

                        }
                    }
                }
            }
            data.append('photoId', photoId);
            data.append('feedback', feedbackText);

            xmlhttp.send(data);
        }
        //click on "Like" container to add/delete like

        if(targ.getAttribute("class") == "photoLike" || targ.getAttribute("class") == "fa fa-thumbs-o-up"){

            var countContainer = document.querySelectorAll(".photoCountLike")[0],
                photoId = targ.getAttribute("photo-id"),
                xmlhttp = getXmlHttp(),
                data = new FormData();

            xmlhttp.open('POST', '/like/push/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var html = xmlhttp.responseText;
                        countContainer.innerHTML = html;
                        showLikeAuthor(photoId);
                    }
                }
            }
            data.append('photoId', photoId);
            xmlhttp.send(data);
        }
        //click on cross at the right top of Photo container to hide it
        if(targ.getAttribute("id") == "closePopup"){
            var popup = document.getElementsByClassName("b-popup")[0],
                body = document.querySelectorAll("body")[0];
            body.style="overflow-y:auto";
            popup.setAttribute("class", modifyClassList(popup.getAttribute("class"), "add", "hiddenElement"));

        }
        //click on "Delete photo" btn
        if(targ.getAttribute("id") == "deletePhotoBtn"){
            scrollTo(0,0);
            var overlay = document.getElementsByClassName("modal-backdrop")[0],
                photoId = targ.getAttribute("data-id"),
                albumId = targ.getAttribute("album-id"),
                yesBtn = document.getElementById("deletePhotoFinalBtn"),
                noBtn =document.getElementsByClassName("closeDeletePhoto")[0],
                textContainer = document.querySelectorAll("#myModalPhotoDelete h4")[0];
            textContainer.innerHTML = "Are you sure, you want to delete this photo?";
            yesBtn.setAttribute("class", modifyClassList(yesBtn.getAttribute("class"), "delete", "hiddenElement"));
            noBtn.setAttribute("class", modifyClassList(noBtn.getAttribute("class"), "delete", "hiddenElement"));

            overlay.style = 'z-index: 15';
            yesBtn.setAttribute("data-id", photoId);
            yesBtn.setAttribute("album-id", albumId);
        }
        //click on "Yes" in Delete btn container
        if(targ.getAttribute("id") == "deletePhotoFinalBtn"){

            var photoId = targ.getAttribute("data-id"),
                albumId = targ.getAttribute("album-id"),
                xmlhttp = getXmlHttp(),
                data = new FormData();
            xmlhttp.open('POST', '/photo/delete/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var html = xmlhttp.responseText,
                            textContainer = document.querySelectorAll("#myModalPhotoDelete h4")[0];
                        textContainer.innerHTML = "Congratulations, photo is deleted successfully!";
                        var yesBtn = document.getElementById("deletePhotoFinalBtn"),
                            noBtn =document.getElementsByClassName("closeDeletePhoto")[0];
                        yesBtn.setAttribute("class", modifyClassList(yesBtn.getAttribute("class"), "add", "hiddenElement"));
                        noBtn.setAttribute("class", modifyClassList(noBtn.getAttribute("class"), "add", "hiddenElement"));

                        updatePhotos(albumId);
                    }
                }
            }
            data.append('photoId', photoId);
            xmlhttp.send(data);
        }

        //click on "Edit Photo Info" btn
        if(targ.getAttribute("id") == "editPhotoBtn") {
            var photoId = targ.getAttribute("data-id"),
                xmlhttp = getXmlHttp(),
                data = new FormData();

            xmlhttp.open('POST', '/photo/getPhotoInfo/', true);
            xmlhttp.onreadystatechange = function () {

                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {

                        var html = xmlhttp.responseText,
                            container = document.querySelectorAll("#myModalPhotoEdit .modal-content")[0];
                        container.innerHTML = html;

                    }
                }
            }
            data.append('photoId', photoId);
            xmlhttp.send(data);
        }

        //click on "Yes" in Edit photo container
        if(targ.getAttribute("id") == "editPhoto") {
            var photoTitle = document.querySelectorAll('#photoEditTitleInput')[0].value,
                photoId = targ.getAttribute("data-id"),
                albumId = targ.getAttribute("album-id"),
                photoDescription = document.querySelectorAll('#photoEditDescriptionInput')[0].value,
                photoPhoto = document.getElementById("filePhotoEditInput").files[0],
                xmlhttp = getXmlHttp();

            var photoName = "";

            if (photoPhoto) {
                photoName = photoPhoto['name'];
            }
            validate(photoInfoform, 3);

            if (document.getElementsByClassName('error-message').length !== 0) {
                event.preventDefault();

            } else {

                //ajax to edit in db

                xmlhttp.open('POST', '/photo/edit/', true);

                xmlhttp.onreadystatechange = function () {

                    if (xmlhttp.readyState == 4) {
                        if (xmlhttp.status == 200) {
                            var yesBtn = document.getElementById("editPhoto"),
                                noBtn = document.getElementById("closePhotoEdit"),
                                answerContainer= document.querySelectorAll("#myModalPhotoEdit .answer")[0];

                            updatePhotos(albumId);
                            yesBtn.setAttribute("class", modifyClassList(yesBtn.getAttribute("class"),"add","hiddenElement"));
                            noBtn.setAttribute("class", modifyClassList(noBtn.getAttribute("class"),"add","hiddenElement"));
                            photoInfoform.setAttribute("class", modifyClassList(photoInfoform.getAttribute("class"),"add","hiddenElement"));
                            answerContainer.innerHTML = "Congratulations, photo " + photoTitle + " is updated!";
                            updatePhotoInfo(photoId);
                        }
                    }
                }
                var data = new FormData();
                data.append('title', photoTitle);
                data.append('description', photoDescription);
                data.append('photoId', photoId);
                data.append('photo', photoPhoto);
                data.append('photoName', photoName);
                data.append('directory', 'photo');
                xmlhttp.send(data);
            }
        }
        //click on "Arrow right" in Photo container
        if(targ.getAttribute("class") == "fa fa-arrow-right"){
            var photoId = targ.getAttribute("photo-id"),
                userId = targ.getAttribute("user-id"),
                photos = document.querySelectorAll(".photoContainer img"),
                photoIdNeed = getNeedPhotoId(photos,"data-id", photoId, "forward");
            updatePhotoInfo(photoIdNeed,userId);

        }
        //click on "Arrow left" in Photo container
        if(targ.getAttribute("class") == "fa fa-arrow-left"){
            var photoId = targ.getAttribute("photo-id"),
                userId = targ.getAttribute("user-id"),

                photos = document.querySelectorAll(".photoContainer img"),
                photoIdNeed = getNeedPhotoId(photos,"data-id", photoId, "backward");
            updatePhotoInfo(photoIdNeed,userId);

        }
        //click on "Back to albums" btn
        if(targ.getAttribute("class") == "backToAlbums"){
            var userId = targ.getAttribute("user-id");
            if(userId){
                seeUserInfo(userId)
            }else{
                updateUserCabinet();
            }
        }
        //click on top image in left SideBar to open users page
        if((targ.parentNode.getAttribute("class") == "imgContainer") && (targ.tagName="IMG")){
            var userId = targ.getAttribute("user-id");
            seeUserInfo(userId);
        }
        //click on User in Left Sidebar to see user's data
        if($(targ).closest(".userInfo")[0]){
            var elem = $(targ).closest(".col-xs-12")[0],
                userId = elem.getAttribute("user-id");
            seeUserInfo(userId);
        }
        //click on "Edit user profile" in "Private cabinet" container
        if (targ.getAttribute("id") == "cabinetBtn") {
            var container = privateCabinetform;
            container.setAttribute("class", modifyClassList(container.getAttribute("class"), "delete", "hiddenElement"));
            editCabinet.setAttribute("class", modifyClassList(editCabinet.getAttribute("class"), "delete", "hiddenElement"));
            closeInCabinet.setAttribute("class", modifyClassList(closeInCabinet.getAttribute("class"), "delete", "hiddenElement"));
            document.querySelectorAll("#myModalPrivateCabinet .answer")[0].innerHTML = "";
        }

    })
    //click on "Login" button in header
    loginHeaderBtn.addEventListener("click", function (event) {
        var targ = event.target;
        var container = loginform;
        var answerContainer = document.getElementsByClassName("answer")[0];
        loginInside.setAttribute("class", modifyClassList(container.getAttribute("class"), "delete", "hiddenElement"));
        //show register form in register modal
        container.setAttribute("class", modifyClassList(container.getAttribute("class"), "delete", "hiddenElement"));
        //clean answer container in register modal
        answerContainer.innerText = "";
    });
    //click on "Login" button in Login container
    var login = document.getElementById("logIn");
    login.addEventListener("click", function (event) {

        validate(loginform, 0);
        if (document.getElementsByClassName('error-message').length !== 0) {
            event.preventDefault();

        } else {
            var targ = event.target;
            var container = targ.parentNode.parentNode;
            var inputs = container.getElementsByTagName('input');
            var login = inputs[0].value;
            var password = inputs[1].value;
            var xmlhttp = getXmlHttp();
            xmlhttp.open('POST', '/user/login/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var html = xmlhttp.responseText,
                            form = container.getElementsByClassName("form-horizontal")[0];
                        answerContainer = container.getElementsByClassName("answer")[0];
                        //form.appendChild(html);
                        answerContainer.innerHTML = html;
                        var status = document.querySelectorAll(".answer p")[0].getAttribute("data-id");

                        if (status == "1") {
                            //form.innerHTML = "";
                            form.setAttribute("class", modifyClassList(form.getAttribute("class"), "add", "hiddenElement"));
                            var userId = document.querySelectorAll(".answer p")[0].getAttribute("user-id");
                            document.getElementById("userId").innerText = userId;
                            changeHeaderButtons(true);
                            loginInside.setAttribute("class", modifyClassList(container.getAttribute("class"), "add", "hiddenElement"));

                            window.location.reload();
                            overlay.setAttribute("class", modifyClassList(overlay.getAttribute("class"), "delete", "hiddenElement"));
                            loader.setAttribute("class", modifyClassList(loader.getAttribute("class"), "delete", "hiddenElement"));
                            seeUserInfo(userId);
                        }
                    }
                }
            };
            var data = new FormData();
            data.append('loginLogin', login);
            data.append('passwordLogin', password);
            data.append('submitLogin', "submit");
            xmlhttp.send(data);
        }
    });

    //click on "Logout" button in header
    logout.addEventListener("click", function () {
        var xmlhttp = getXmlHttp(),
            answerContainer = document.getElementsByClassName("answer")[0];
        xmlhttp.open('POST', '/user/logout/', true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    //change innerText of hidden element with userId
                    document.getElementById("userId").innerText = "";
                    changeHeaderButtons(false);
                }
            }
        }
        xmlhttp.send();
        window.location.reload();
        overlay.setAttribute("class", modifyClassList(overlay.getAttribute("class"),"delete","hiddenElement"));
        loader.setAttribute("class", modifyClassList(loader.getAttribute("class"),"delete","hiddenElement"));
    });

    //click on "Register" button in header
    registerHeaderBtn.addEventListener("click", function (event) {
        var targ = event.target;
        var container = registerform;
        var answerContainer = document.getElementsByClassName("answer")[1];
        var registerInside = document.getElementById("register"),
            loginInside = document.getElementById("loginInRegister");
        //show register form in register modal
        container.setAttribute("class", modifyClassList(container.getAttribute("class"), "delete", "hiddenElement"));
        //clean answer container in register modal
        answerContainer.innerText = "";

        //show register button and hide login button
        registerInside.setAttribute("class", modifyClassList(registerInside.getAttribute("class"), "delete", "hiddenElement"));
        loginInside.className += " hiddenElement";
        //clean input fields in form
        cleanForm(container);
    });

    //click on "Register" button in "Register" container
    var register = document.getElementById("register");
    register.addEventListener("click", function (event) {
        var xmlhttp = getXmlHttp(),
            targ = event.target,
            container = targ.parentNode.parentNode,
            form = container.getElementsByClassName("form-horizontal")[0],
            answerContainer = container.getElementsByClassName("answer")[0],
            registerInside = document.getElementById("register");
        validate(registerform, 1);

        if (document.getElementsByClassName('error-message').length !== 0) {
            event.preventDefault();
        } else {

            xmlhttp.open('POST', '/user/register/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var html = xmlhttp.responseText;
                        answerContainer.innerHTML = html;
                        var status = document.querySelectorAll(".answer p")[0].getAttribute("data-id");
                        if (status == "1") {
                            form.setAttribute("class", modifyClassList(form.getAttribute("class"), "add", "hiddenElement"));
                            loginInside.setAttribute("class", modifyClassList(loginInside.getAttribute("class"), "delete", "hiddenElement"));
                            registerInside.className += " hiddenElement";
                        }
                    }
                }
            };

            var name = document.getElementById("nameRegisterInput").value,
                surname = document.getElementById("surnameRegisterInput").value,
                email = document.getElementById("emailRegisterInput").value,
                dateOfBirth = document.getElementById("birthdateRegisterInput").value,
                sex = document.getElementById("sexRegisterInput").value,
                status = document.getElementById("statusRegisterInput").value,
                login = document.getElementById("loginRegisterInput").value,
                password = document.getElementById("passwordRegisterInput").value,
                photo = document.querySelectorAll("input[type=file]")[0].files[0];

            var data = new FormData();
            data.append('name', name);
            data.append('surname', surname);
            data.append('email', email);
            data.append('dateOfBirth', dateOfBirth);
            data.append('sex', sex);
            data.append('status', status);
            data.append('login', login);
            data.append('password', password);
            data.append('submit', "submit");
            data.append("photo", photo);

            xmlhttp.send(data);
        }
    });

    //click on "Login" in Register container to get into "Login" container
    var loginInRegister = document.getElementById("loginInRegister");
    loginInRegister.addEventListener("click", function () {
        //switch modals
        var close = document.getElementById("closeInRegister");
        close.click();
        var loginHeader = document.getElementById("loginHeaderBtn");
        loginHeader.click();
    });

    //click on "Update" in "Edit User Profile" container;
    editCabinet.addEventListener("click", function (event) {
        var targ = event.target;
        var container = privateCabinetform;
        var answerContainer = document.getElementsByClassName("answer")[2];

        validate(privateCabinetform, 2);
        if (privateCabinetform.getElementsByClassName('error-message').length !== 0) {
            event.preventDefault();
        } else {
            var xmlhttp = getXmlHttp();
            xmlhttp.open('POST', '/cabinet/edit/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var html = xmlhttp.responseText;
                        answerContainer.innerHTML = html;
                        var status = document.querySelectorAll(".answer p")[0].getAttribute("data-id");
                        if (status == "1") {
                            container.setAttribute("class", modifyClassList(container.getAttribute("class"), "add", "hiddenElement"));
                            editCabinet.setAttribute("class", modifyClassList(editCabinet.getAttribute("class"), "add", "hiddenElement"));
                            closeInCabinet.setAttribute("class", modifyClassList(closeInCabinet.getAttribute("class"), "add", "hiddenElement"));
                            updateUserInfoLeftSidebar();
                            updateUserCabinet();
                        }
                    }
                }
            };

            var name = document.getElementById("nameCabinetInput").value,
                surname = document.getElementById("surnameCabinetInput").value,
                email = document.getElementById("emailCabinetInput").value,
                dateOfBirth = document.getElementById("birthdateCabinetInput").value,
                sex = document.getElementById("sexCabinetInput").value,
                status = document.getElementById("statusCabinetInput").value,
                login = document.getElementById("loginCabinetInput").value,
                photo = document.querySelectorAll("input[type=file]")[1].files[0];

            var data = new FormData();
            data.append('name', name);
            data.append('surname', surname);
            data.append('email', email);
            data.append('dateOfBirth', dateOfBirth);
            data.append('sex', sex);
            data.append('status', status);
            data.append('login', login);
            data.append('submit', "submit");
            if (photo) {
                data.append("photo", photo);
            }

            xmlhttp.send(data);
        }
    });
    //click on "Private Cabinet" in header, display private cabinet
    cabinetHeaderBtn.addEventListener("click", function (event) {
        updateUserCabinet();
    });

    //event handler for filter users in leftSidebar, display filtered users
    var userSearchInput = document.getElementById("exampleUserInput");
    userSearchInput.addEventListener("input", function () {
        var userName = userSearchInput.value,
            xmlhttp = getXmlHttp();
        xmlhttp.open('POST', '/user/getUsersByName/', true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    var html = xmlhttp.responseText;
                    //if(html){
                    document.getElementsByClassName('usersData')[0].innerHTML = "";
                    document.getElementsByClassName('usersData')[0].innerHTML = html;
                    var photo = document.querySelectorAll(".usersData  .imgContainer img");
                    for (var i = 0; i < photo.length; i++) {
                        makePhotoSameSize(photo[i], 40, 1.42);
                    }
                    //}
                }
            }
        }

        var data = new FormData();
        data.append('userName', userName);
        xmlhttp.send(data);
    });

    //event handler for scrolling users to the bottom of the page in leftSidebar, display more users
    var scrollUser = document.getElementsByClassName('usersData')[0];
    scrollUser.addEventListener("scroll", function () {
        //scrollUser.scrollHeight;//height of all content without scroll
        //scrollUser.scrollTop;//distance from the top to scroll element
        //scrollUser.clientHeight;//distance of visible part
        if ((scrollUser.scrollHeight - scrollUser.scrollTop - scrollUser.clientHeight) <1) {
            var xmlhttp = getXmlHttp();
            xmlhttp.open('POST', '/user/getUsersList/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var html = xmlhttp.responseText;
                        if (html) {
                            document.getElementsByClassName('usersData')[0].innerHTML += html;
                        }
                    }
                }
            }

            var data = new FormData();
            data.append('start', document.querySelectorAll('.usersData>div').length);
            data.append('quantity', 20);
            xmlhttp.send(data);
        }
    });

    // event handler on change contents of uploaded file in form
    document.body.addEventListener("change", function (event) {

        if (event.target.getAttribute("id") == "fileRegisterInput" || event.target.getAttribute("id") == "fileCabinetInput"
            || event.target.getAttribute("id") == "fileAlbumInput" || event.target.getAttribute("id") == "fileAddAlbumInput"
            || event.target.getAttribute("id") == "fileAddPhotoInput" || event.target.getAttribute("id") == "filePhotoEditInput") {
            var targ = event.target;
            //prepare fileName
            var name = targ.value;
            reWin = /.*\\(.*)/;
            var fileTitle = name.replace(reWin, "$1");
            var fileNameContainer = targ.parentElement.parentElement.getElementsByTagName("i")[0];
            fileNameContainer.innerText = fileTitle;
        }
        //upload new file to the server
        // upload file in "Private Cabinet" to a directory, save to DB
        if (event.target.getAttribute("id") == "fileCabinetInput") {
            var xmlhttp = getXmlHttp(),
                photo = document.querySelectorAll("#fileCabinetInput")[0].files[0],
                userId = document.getElementById("userId").innerText,
                data = new FormData();
            xmlhttp.open('POST', '/user/uploadFile/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var photoContainer = document.querySelectorAll(".photoButton .photo img")[0];
                        photoContainer.setAttribute("src", "/template/images/user/tmp/" + photo.name);
                    }
                }
            }
            data.append("userId", userId);
            data.append("photo", photo);
            xmlhttp.send(data);
        }
        // upload file in "Edit Album Info" to a directory, save to DB
        if (event.target.getAttribute("id") == "fileAlbumInput") {
            var xmlhttp = getXmlHttp(),
                photo = document.querySelectorAll("#fileAlbumInput")[0].files[0],
                id = document.getElementById("editAlbum").getAttribute("data-id"),
                data = new FormData(),
                directory = "album";
            xmlhttp.open('POST', '/index/uploadFile/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var photoContainer = document.querySelectorAll(".photoButton .photo img")[1],
                            html = xmlhttp.responseText,
                            fileNameContainer = document.querySelectorAll(".nameOfUpploadedFile")[0];
                        fileNameContainer.innerHTML = html;
                        fileName = document.querySelectorAll(".uploadedFileName")[0].innerHTML;
                        photoContainer.setAttribute("src", "/template/images/" + directory + "/tmp/" + fileName);

                    }
                }
            }
            data.append("id", id);
            data.append("photo", photo);
            data.append("directory", directory);
            xmlhttp.send(data);
        }
        // upload file in "Add New Album" to a directory, save to DB
        if (event.target.getAttribute("id") == "fileAddAlbumInput") {
            var xmlhttp = getXmlHttp(),
                photo = document.querySelectorAll("#fileAddAlbumInput")[0].files[0],
                data = new FormData(),
                directory = "album",
                userId = document.querySelectorAll("#addAlbumBtn")[0].getAttribute("user-id");

            xmlhttp.open('POST', '/index/uploadFile/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var photoContainer = document.querySelectorAll("#myModalAlbumAdd .photoButton .photo img")[0],
                            html = xmlhttp.responseText,
                            fileNameContainer = document.querySelectorAll(".nameOfUpploadedFile")[0];
                        fileNameContainer.innerHTML = html;
                        fileName = document.querySelectorAll(".uploadedFileName")[0].innerHTML;
                        photoContainer.setAttribute("src", "/template/images/" + directory + "/tmp/" + fileName);

                    }
                }
            }
            data.append("photo", photo);
            data.append("userId", userId);
            data.append("directory", directory);
            xmlhttp.send(data);
        }
        // upload file in "Add New Photo" to a directory, save to DB
        if (event.target.getAttribute("id") == "fileAddPhotoInput") {
            var xmlhttp = getXmlHttp(),
                photo = document.querySelectorAll("#fileAddPhotoInput")[0].files[0],
                data = new FormData(),
                id= document.querySelectorAll("#addPhoto")[0].getAttribute('data-id'),
                directory = "album";

            xmlhttp.open('POST', '/index/uploadFile/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var photoContainer = photoAddform.querySelectorAll(".photoButton .photo img")[0],
                            html = xmlhttp.responseText,
                            fileNameContainer = document.querySelectorAll(".nameOfUpploadedFile")[0];
                        fileNameContainer.innerHTML = html;
                        fileName = document.querySelectorAll(".uploadedFileName")[0].innerHTML;
                        photoContainer.setAttribute("src", "/template/images/" + directory + "/tmp/" + fileName);

                    }
                }
            }
            data.append("photo", photo);
            data.append("directory", directory);
            data.append("id", id);

            xmlhttp.send(data);
        }
        // upload file in "Edit Photo Info" to a directory, save to DB
        if (event.target.getAttribute("id") == "filePhotoEditInput") {
            var xmlhttp = getXmlHttp(),
                photo = document.querySelectorAll("#filePhotoEditInput")[0].files[0],
                yesBtn = document.querySelectorAll("#editPhoto")[0],
                photoId = yesBtn.getAttribute("data-id"),

                data = new FormData(),
                directory = "photo";

            xmlhttp.open('POST', '/index/uploadFile/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var photoContainer = photoInfoform.querySelectorAll(".photoButton .photo img")[0],
                            html = xmlhttp.responseText,
                            fileNameContainer = document.querySelectorAll(".nameOfUpploadedFile")[0];
                        fileNameContainer.innerHTML = html;
                        fileName = document.querySelectorAll(".uploadedFileName")[0].innerHTML;
                        photoContainer.setAttribute("src", "/template/images/" + directory + "/tmp/" + fileName);

                    }
                }
            }
            data.append("photo", photo);
            data.append("directory", directory);
            data.append("photoId", photoId);
            xmlhttp.send(data);
        }
    });

    //mouseover on Like Container to show div with like authors
    var photoContainer = document.getElementsByClassName("photoLike")[0];
    $(document).on('mouseover', photoContainer, function (event) {
        var targ = event.target;
        if (targ.className == "photoLike") {
            var photoId = targ.getAttribute("photo-id");
            showLikeAuthor(photoId);
        }

    });
    //mouseout on Like Container to hide div with like authors
    $(document).on('mouseout', photoContainer, function (event) {
        var targ = event.target;

        if (targ.className == "photoLike") {
            var container = document.getElementsByClassName("likeAuthor")[0];

            container.setAttribute("class", modifyClassList(container.getAttribute("class"), "add", "hiddenElement"));
        }
    });

    //Pagination for photos
    /**
     * Function to check the position of photo between all photos
     * @param arr arr
     * @param string attr
     * @param string attrVal
     * @returns string{*}
     */
    function checkPosition(arr, attr, attrVal){
        var result;
        for(var i = 0; i<arr.length; i++){
            if(arr[i].getAttribute(attr) == attrVal){
                if((arr.length-i) == arr.length){
                    result = "first";
                }
                if((arr.length-i) == 1){
                    result = "last";
                }
                if((arr.length-i) == arr.length && (arr.length-i) == 1){
                    result = "firstlast";
                }
            }
        }
        return result;
    }
    /**
     * Function to get photoId of next photo, that must be shown
     * @param arr arr
     * @param string attr
     * @param string attrVal
     * @param string dest
     * @returns int{*}
     */
    function getNeedPhotoId(arr,attr, attrVal,dest){
        var needPhotoId;
        for(var i = 0; i<arr.length; i++){
            if(arr[i].getAttribute(attr) == attrVal){
                switch(dest){
                    case "forward":
                        var m = i+1;
                        needPhotoId = arr[m].getAttribute(attr);
                        break;
                    case "backward":
                        var k = i-1;
                        needPhotoId = arr[k].getAttribute(attr);
                        break;
                }
            }
        }
        return needPhotoId;
    }

    /**
     * Function to update users cabinet after profile data changes
     */
    function updateUserCabinet() {
        //update users cabinet
        var xmlhttp = getXmlHttp();
        xmlhttp.open('POST', '/cabinet/viewCabinet/', true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    var html = xmlhttp.responseText;
                    mainContent.innerHTML = "";
                    mainContent.innerHTML = html;
                }
            }
        };
        xmlhttp.send();

    }

    /**
     * Function to update user’s info in left Sidebar
     */
    function updateUserInfoLeftSidebar() {
        var xmlhttp = getXmlHttp();
        xmlhttp.open('POST', '/cabinet/userInfo/', true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    var html = xmlhttp.responseText;
                    var container = document.getElementsByClassName("userContainer")[0];
                    container.innerHTML = "";
                    container.innerHTML = html;

                }
            }
        };
        xmlhttp.send();
    }

    /**
     * Function to update Photos in user Cabinet
     * @param int albumId
     * @param int userId
     */
    function updatePhotos(albumId,userId) {
        var id = albumId,
            titleContainer = document.getElementsByClassName("titleUserInfo")[1],
            xmlhttp = getXmlHttp(),
            data = new FormData();

        if(userId){
            xmlhttp.open('POST', '/photo/indexUsers/', true);
        }else{
            xmlhttp.open('POST', '/photo/index/', true);
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    var html = xmlhttp.responseText,
                        albumContainer = document.querySelectorAll(".userPhotoMain div.col-xs-12")[0],
                        albumSpan = document.querySelectorAll(".userPhotoMain>span")[0];

                    albumContainer.innerHTML = html;
                    var albumTitle = document.getElementsByClassName("albumTitle")[0].innerHTML;
                    titleContainer.innerHTML = "Photos in album " + albumTitle;

                    if(albumSpan){
                        albumSpan.setAttribute("class", modifyClassList(albumSpan.getAttribute("class"), "add", "hiddenElement"));
                    }

                    setTimeout(function () {
                        var photos = document.querySelectorAll(".photoContainer img");
                        for (var i = 0; i < photos.length; i++) {
                            //makePhotoSameSize(photos[i], 190, 1.61);
                        }

                    }, 50);
                }
            }
        }
        data.append('id', id);
        xmlhttp.send(data);
    }
    /**
     * Function to show users info by userId
     * @param int userId
     */
    function seeUserInfo(userId){
        var xmlhttp = getXmlHttp();
        xmlhttp.open('POST', '/index/viewUserInfo/', true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    var html = xmlhttp.responseText;
                    mainContent.innerHTML = "";
                    mainContent.innerHTML = html;
                }
            }
        }
        var data = new FormData();
        data.append('userId', userId);
        xmlhttp.send(data);
    }

    /**
     * Function to update photo in "Photo" container from DB
     * @param int photoId
     * @param int userId
     */
        function updatePhotoInfo(photoId,userId) {
        var body = document.querySelectorAll("body")[0],
            photos = document.querySelectorAll(".photoContainer img"),
            xmlhttp = getXmlHttp(),
            data = new FormData();
        body.style = "overflow-y:hidden";
        if(userId){
            xmlhttp.open('POST', '/photo/viewUsers/', true);
        }else{
            xmlhttp.open('POST', '/photo/view/', true);
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    var html = xmlhttp.responseText,
                        popup = document.getElementsByClassName("b-popup")[0],
                        container = document.getElementsByClassName("b-popup-content")[0];
                    popup.setAttribute("class", modifyClassList(popup.getAttribute("class"), "delete", "hiddenElement"));
                    container.innerHTML = html;
                    var status = checkPosition(photos, "data-id", photoId),
                        arrowBackward = document.querySelectorAll(".fa.fa-arrow-left")[0],
                        arrowForward = document.querySelectorAll(".fa.fa-arrow-right")[0];

                    switch (status) {
                        case "first":
                            arrowBackward.setAttribute("class", modifyClassList(arrowBackward.getAttribute("class"), "add", "hiddenElement"));
                            break;
                        case "last":
                            arrowForward.setAttribute("class", modifyClassList(arrowForward.getAttribute("class"), "add", "hiddenElement"));
                            break;
                        case "firstlast":
                            arrowBackward.setAttribute("class", modifyClassList(arrowBackward.getAttribute("class"), "add", "hiddenElement"));
                            arrowForward.setAttribute("class", modifyClassList(arrowForward.getAttribute("class"), "add", "hiddenElement"));
                            break;
                    }
                }
            }
        }
        data.append('photoId', photoId);
        xmlhttp.send(data);
    }
    /**
     * Function to show like authors when mouseenter "Like" container
     * @param int photoId
     */
        function showLikeAuthor(photoId) {
            var xmlhttp = getXmlHttp(),
                data = new FormData();

            xmlhttp.open('POST', '/like/showUser/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var html = xmlhttp.responseText,
                            container = document.getElementsByClassName("likeAuthor")[0];
                        container.setAttribute("class", modifyClassList(container.getAttribute("class"), "delete", "hiddenElement"));
                        container.innerHTML = html;
                        var photos = document.querySelectorAll(".likeAuthor img");
                        //change the position of div
                        container.style.left = document.getElementsByClassName("likeContainer")[0].offsetLeft + "px";
                    }
                }
            }
            data.append('photoId', photoId);
            xmlhttp.send(data);
        }

    /**
     * Function to show and hide feedbacks
     * @param int photoId
     * @param int start
     * @param int limit
     */
        function showFeedback(photoId, start, limit) {
            var xmlhttp = getXmlHttp(),
                data = new FormData();
            xmlhttp.open('POST', '/feedback/allFeedback/', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var html = xmlhttp.responseText,
                            container = document.getElementsByClassName("photoFeedbacks")[0];
                        container.innerHTML = html;
                    }
                }
            }
            data.append('photoId', photoId);
            data.append('start', start);
            data.append('limit', limit);

            xmlhttp.send(data);
        }


    /**
     * Function to changetext in header
     */
        var timerId = setInterval(function () {
            var randomNumber = randomInteger(0, phrases.length - 1);
            var title = document.createTextNode(phrases[randomNumber].title);
            var i = document.createElement("i");

            var author = document.createTextNode(" -" + phrases[randomNumber].author);
            document.querySelectorAll(".phrase p")[0].innerHTML = "";
            document.querySelectorAll(".phrase p")[0].appendChild(title);
            document.querySelectorAll(".phrase p")[0].appendChild(i);
            document.querySelectorAll(".phrase i")[0].appendChild(author);
        }, 10000);
        //data to be changed in header
        var phrases = [
            {
                "title": "There are no bad pictures; that's just how your face looks sometimes.",
                "author": "Abraham Lincoln"
            },
            {
                "title": "Taking pictures is savoring life intensely, every hundredth of a second.",
                "author": "Marc Riboud"
            },
            {"title": "A great photograph is one that fully expresses what one feels.", "author": "Ansel Adams"},
            {
                "title": "The camera is an instrument that teaches people how to see without a camera.",
                "author": "Dorothea Lange"
            },
            {
                "title": "For me, the camera is a sketch book, an instrument of intuition and spontaneity.",
                "author": "Eudora Welty"
            },
        ];

    /**
     * Function to calculate random integer between min an max
     * @param int min
     * @param int max
     * @returns int{*}
     */
        function randomInteger(min, max) {
            var rand = min + Math.random() * (max - min)
            rand = Math.round(rand);
            return rand;
        }

        //
    /**
     * Function to get instance of object XMLHttpRequest
     * @returns obj {*}
     */
        function getXmlHttp() {
            var xmlhttp;
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (E) {
                    xmlhttp = false;
                }
            }
            if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                xmlhttp = new XMLHttpRequest();
            }
            return xmlhttp;
        }

    /**
     *Function to delete or add class
     * @param string str
     * @param string act
     * @param string cl
     * @returns string {*}
     */
        function modifyClassList(str, act, cl) {
            var arr = str.split(" ");
            switch (act) {
                case 'add':
                    arr[arr.length] = cl;
                    break;
                case 'delete':
                    for (var i = 0; i < arr.length; i++) {
                        if (arr[i] == cl) {
                            delete arr[i];
                        }
                    }
                    break;
            }
            return arr.join(" ");
        }


    /**
     * Function to change header buttons depend on is user logged in
     * @param string loginStat
     */
        function changeHeaderButtons(loginStat) {
            var loginHeaderBtn = document.querySelectorAll("#loginHeaderBtn")[0],
                registerHeaderBtn = document.querySelectorAll("#registerHeaderBtn")[0],
                logoutHeaderBtn = document.querySelectorAll("#logoutHeaderBtn")[0],
                cabinetHeaderBtn = document.querySelectorAll("#cabinetHeaderBtn")[0],
                actionFirst = "delete",
                actionSecond = "add";
            if (loginStat) {

                actionFirst = "add";
                actionSecond = "delete";
            }
            loginHeaderBtn.setAttribute("class", modifyClassList(loginHeaderBtn.getAttribute("class"), actionFirst, "hiddenElement"));
            registerHeaderBtn.setAttribute("class", modifyClassList(registerHeaderBtn.getAttribute("class"), actionFirst, "hiddenElement"));
            logoutHeaderBtn.setAttribute("class", modifyClassList(logoutHeaderBtn.getAttribute("class"), actionSecond, "hiddenElement"));
            cabinetHeaderBtn.setAttribute("class", modifyClassList(cabinetHeaderBtn.getAttribute("class"), actionSecond, "hiddenElement"));
        }


    /**
     * Function to perform form validation, check the correctness of input data
     * @param string form
     * @param int index
     */
        function validate(form, index) {

            for (var i = 0; i < form.elements.length; i++) {
                if (form.elements[i].name !== 'filename') {
                    resetError(form.elements[i].name + 'Input', form);
                }
            }

            for (var i = 0; i < form.elements.length; i++) {
                if (form.elements[i].name == "password") {
                    checkPassword(form.elements[i].name + 'Input', form);
                }
                if (form.elements[i].value == "" && form.elements[i].name != "filename") {

                    showError(form.elements[i].name + 'Input', 'Fill the ' + form.elements[i].name + ' field', form);


                }

            }


            if (form == "privateCabinetform" || index == "registerform") {
                checkEmail('emailInput', form);
            }

        }

    /**
     * Function to delete error messages
     * @param string cl
     * @param int index
     */
        function resetError(cl, form) {
            var container = form.getElementsByClassName(cl)[0];

            if (container.children.length > 1) {
                for (var i = 1; i < container.children.length; i++) {
                    var msgElem = (container.children[i]);
                    container.removeChild(msgElem);
                }
            }
        }

    /**
     * Function to show error messages
     * @param string cl
     * @param string errorMessage
     * @param int index
     */
        function showError(cl, errorMessage, form) {
        var container = form.getElementsByClassName(cl)[0],
            msgElem = document.createElement('span');

        msgElem.className = "error-message";
        msgElem.innerHTML = errorMessage;

            if (container.children.length > 1) {
                resetError(container.children[0].name + 'Input', index);
            }
            container.appendChild(msgElem);
        }

    /**
     * Function to clean form inputs
     * @param string formName
     */
        function cleanForm(formName) {
            for (var i = 0; i < formName.elements.length; i++) {
                if (formName.elements[i].name !== 'filename') {
                    formName.elements[i].value = "";
                }
            }
        }


    /**
     * Function clean fileInput
     * @param string form
     * @param int index
     * @param string directory
     */
        function cleanFileInput(form, index, directory) {
            document.querySelectorAll("input[type=file]")[index].value = "";
            form.querySelectorAll(".fileName i")[0].innerHTML = "File is not chosen";
            form.querySelectorAll("img")[0].setAttribute("src", "/template/images/" + directory + "/undefined.jpg");
        }

    /**
     * Function to validate entered email
     * @param string cl
     * @param int index
     */
        function checkEmail(cl, form) {
            var userEmail = form.getElementsByClassName(cl)[0].value,
                email_pattern = /[0-9a-z_]+@[0-9a-z]+\.[a-z]{2,5}/i;

            if (!email_pattern.test(userEmail) && userEmail !== "") {
                showError(cl, "Email is not valid", form);
            }
        }

    /**
     * Function to validate entered password
     * @param string cl
     * @param int index
     */
        function checkPassword(cl, form) {

            var userPassword = form.getElementsByClassName(cl)[0].value,
                password_pattern = /[\d\w]{6,12}/i;

            if (!password_pattern.test(userPassword) && userPassword !== "") {
                showError(cl, "Password is not valid", form);
            }
        }

    function fixLikeDivPosition(element){
        var dest = document.getElementsByClassName("likeContainer")[0].offsetLeft;

        element.style.left = dest + "px";
    }

});

//Function to change photo size
//function makePhotoSameSize(photo, maxWidth, index) {
//    var im = new Image();
//    im.src = photo.src;
//    var margins = ((maxWidth * im.height / im.width) - maxWidth / index) / 2;
//    if (margins > 2) {
//        photo.style.margin = "-" + Math.round(margins) + "px 0px";
//    }
//    if (im.width < maxWidth) {
//
//        photo.style.width = maxWidth + "px";
//        photo.parentElement.style.height = 116 + "px";
//    }
//}
//
////function to change width and height of elements, if they take more than mwxWidth, maxHeight
//function makePhotoCorrectSize(photo, maxHeight, maxWidth) {
//    var im = new Image();
//    im.src = photo.src;
//
//    if (photo.height > maxHeight) {
//
//        var widthAdopted = (im.width * maxHeight) / im.height;
//        photo.style.maxHeight = maxHeight + "px";
//        photo.style.maxWidth = widthAdopted + "px";
//    }
//    if (photo.width > maxWidth) {
//
//        var heightAdopted = (maxWidth * im.height) / im.width;
//        photo.style.maxWidth = maxWidth + "px";
//        photo.style.maxHeight = heightAdopted + "px";
//    }
//}
//
////makePhotoCorrectSize(photoProfSidebar, 160, 255);