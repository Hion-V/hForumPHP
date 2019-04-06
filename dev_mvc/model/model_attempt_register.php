<?php
//Include classes
include_once("./controller/Database.php");
include_once("./controller/HUtils.php");
if(HUtils::issetPost(['email', 'pass', 'name'])){
    if($_POST['pass'] == $_POST['pass2']){
        //Check of email aanwezig is in de database
        if(!Database::checkUsedEmail($_POST['email']) && !Database::checkUsedUsername($_POST['name'])){
            Database::registerUser($_POST['email'], $_POST['pass'], $_POST['name']);
        }
    }
    else{
        echo("REGISTRATION FAILED: PASSWORD VERIFICATION MISSMATCH");
    }
}
else{
    echo "POST UNSUCCESFUL: POST DATA INCOMPLETE OR NOT FOUND";
}
?>