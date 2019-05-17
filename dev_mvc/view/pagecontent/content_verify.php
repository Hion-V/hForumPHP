<?php

if(isset($completed)){
    echo("account activated!");
}
else{
    echo("account activation went wrong!
    <br> Go here: <a href='?p=resend_email'>Resend email verification</a>
    <br>
    
    ");
}



?>