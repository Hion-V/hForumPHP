<?php
class TA_TestDBUser extends TestAction{
    public function __construct()
    {
        parent::__construct();
    }
    public function execute()
    {
        $user = DBUser::getUserByUID(0 );
    }
}
