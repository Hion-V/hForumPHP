<?php

if(UserSession::isUserSignedIn()){
    echo "LIST OF BOARDS LMAO";
}
else{
    echo "You must be signed in to view this page.";
}

?>