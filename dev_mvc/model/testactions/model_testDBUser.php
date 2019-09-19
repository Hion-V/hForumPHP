<?php
if(isset($_POST['auth'])){
    if($_POST['auth'] == getenv('ADMIN_ACTION_KEY')){
        execute();
    }
}else{
    echol('you have no authorization to do that');
}
function execute(){
    
}