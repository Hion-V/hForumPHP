<?php
if(UserSession::isUserSignedIn()){
    include("./view/pagecontent/header/content_header_signedin.php");
}else{
    include("./view/pagecontent/header/content_header_signedout.php"); 
}
?>