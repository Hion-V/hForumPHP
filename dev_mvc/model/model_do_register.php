<?php
//Include classes
include_once("./controller/Database.php");
include_once("./controller/HUtils.php");
if(HUtils::issetPost(['email', 'pass', 'pass2', 'name'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    $name = $_POST['name'];
    if($pass == $pass2){
        //Check of email aanwezig is in de database
        if(!Database::checkUsedEmail($email) && !Database::checkUsedUsername($name)){
            $verificationKey = HUtils::generateRandomKey();
            while(Database::doesUserActivationKeyExist($verificationKey)){
                $verificationKey = HUtils::generateRandomKey();
            }
            //TO DO: Create verification key
            Database::registerUser($email, $pass, $name);
            $uid = Database::getUID($email, $pass);
            Database::registerActivationKey($uid,$verificationKey);
            $message = 'Please follow the link to verify your account: http://localhost/webforum_redux/index.php?p=verify&key='.$verificationKey;
            $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($email, "Account Verification", $message, $headers);
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