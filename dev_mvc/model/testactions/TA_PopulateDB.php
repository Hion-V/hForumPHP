<?php
namespace model\testactions;
use controller\db\Database;
use controller\db\DBBoard;
use controller\db\DBReply;
use controller\db\DBThread;
use controller\db\DBUser;
use model\forum\Board;
use model\forum\Thread;
use PDO;
use PDOException;
class TA_PopulateDB extends TestAction{
    function TA_PopulateDB(){
        parent::__construct();
    }
    function registerUser($email, $password, $username){
        DBUser::registerUser($email,$password,$username);
        $user = DBUser::getUserByEmail($email);
        Database::registerActivationKey($user->getId(), $username);
        Database::activateUser($username);
    }


    function execute(){
        try{
            //connect to sql server
            $con = Database::connectToDB();
            
            
            self::logMessage('table doesnt exist', "OK");


            $this->registerUser('andreas@andreas.nl','jenk', 'andreas');
            $this->registerUser('bram@bram.nl','jenk', 'bram');


            self::logMessage("created test users", "OK");
                        
            DBBoard::registerBoard(new Board(-1, 'General Discussion', 'Plek om algemene discussie te voeren.', 0));
            DBBoard::registerBoard(new Board(-1, 'Off Topic', 'Voor alle irrelevante zooi.', 0));
            
            
            
            
            self::logMessage("created test boards", "OK");


            DBThread::createThread(new Thread(-1, 1, 1, 'Test Thread', 'Deze thread is een test.', '1337-04-20 13:37:00'));
            DBThread::createThread(new Thread(-1, 1, 2, 'Frits', 'Frits niffo', '1337-04-20 13:37:00'));

            self::logMessage("created test threads", "OK");

            DBReply::createReply(1, 1, 'heehee eks dee');
            DBReply::createReply(1, 1, 'sup');
            DBReply::createReply(2, 2, 'fritselitsel');
            DBReply::createReply(2, 1, 'heb je daar prebleem mee ofzo');
            
            self::logMessage("created test replies", "OK");
        }
        catch(PDOException $e){
            self::logMessage("created test replies", "FAILURE");
            die("pdo exception, cannot connect to sql:<br> $e");
            //test change 7
        }
    }
}  