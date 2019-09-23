<?php
require_once(ROOT_DIR.'/controller/db/DBUser.php');
require_once(ROOT_DIR.'/model/forum/User.php');
class TA_TestDBUser extends TestAction{
    public function __construct()
    {
        parent::__construct();
    }
    public function execute()
    {
        $users = DBUser::getAllUsers();

        foreach ($users as $user) {
            $user->setReg_Date('1337-13-37 13:37:69');
        }
        echo "<div id='response_json'>";
        echo (json_encode($users));
        echo "</div>";
    }
}
