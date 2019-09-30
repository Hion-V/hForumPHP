<?php
namespace model\testactions;
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
        echo "<div id='response_json'>";
        echo (json_encode($users));
        echo "</div>";
    }
}
