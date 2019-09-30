<?php
namespace model\testactions;
use controller\db\DBUser;
use model\forum\User;
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
