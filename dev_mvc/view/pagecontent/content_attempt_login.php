<?php
if(UserSession::isUserSignedIn()){
    include("./view/pagecontent/login/content_login_succesful.php");
}else{
    include("./view/pagecontent/login/content_login_unsuccesful.php");
}
?>