<?php
//Include classes
require_once("./controller/db/Database.php");
require_once("./controller/db/DBUser.php");
require_once("./controller/HUtils.php");
if(HUtils::issetPost(['email', 'pass', 'pass2', 'name'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    $name = $_POST['name'];
    if($pass == $pass2){
        //Check of email aanwezig is in de database
        if(!DBUser::checkUsedEmail($email) && !DBUser::checkUsedUsername($name)){
            $verificationKey = HUtils::generateRandomKey();
            while(DBUser::doesUserActivationKeyExist($verificationKey)){
                $verificationKey = HUtils::generateRandomKey();
            }
            //TO DO: Create verification key
            DBUser::registerUser($email, $pass, $name);
            $uid = DBUser::getUID($email, $pass);
            DBUser::registerActivationKey($uid,$verificationKey);
            $message = 'Please follow the link to verify your account: http://localhost/webforum_redux/hforumphp/dev_mvc/index.php?p=verify&key='.$verificationKey;
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