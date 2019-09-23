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
        $user = DBUser::getUserByUID(9 );
        self::logMessage($user->getUsername());
        self::logMessage($user->getEmail());
        self::logMessage($user->getPassword());
    }
}
