<?php
namespace model\testactions;
use controller\db\Database;
use PDO;
use PDOException;
class TA_PopulateDB extends TestAction{
    function TA_PopulateDB(){
        parent::__construct();
    }
    function execute(){
        try{
            //connect to sql server
            $con = Database::connectToDB();
            
            
            self::logMessage('table doesnt exist', "OK");
            $query = $con->query("INSERT INTO users ( `username`, `email`, `password`, `login_date`, `reg_ip`, `active`) VALUES 
                                                    ( 'andreas', 'andreas@andreas.nl', 'jenk', '2019-01-01 14:35:33', '192.168.0.2', 1),
                                                    ( 'bram', 'bram@bram.nl', 'jenk', '2019-01-01 14:35:33', '192.168.0.1', 1)");
            self::logMessage("created test users", "OK");
            $query = $con->query("INSERT INTO `board` ( `name`, `description`, `permLevel`) VALUES ('General Discussion', 'Plek om algemene discussie te voeren.', '0'), 
                                                                                                  ('Off Topic', 'Voor alle irrelevante zooi.', '0')");
            self::logMessage("created test boards", "OK");
            $query = $con->query("INSERT INTO `thread` ( `users_ID`, `board_ID`, `title`, `text`, `date_created`) VALUES ('1', '1', 'Test thread', 'Deze thread is een test.', '2019-06-20 13:55:37'), 
                                                                                                                        ('1', '2', 'Waa', 'Frist niffo', '2019-06-20 13:56:42')");
            self::logMessage("created test threads", "OK");
            $query = $con->query("INSERT INTO `reply` ( `thread_ID`, `users_ID`, `content`, `date_created`) VALUES ('1', '1', 'heehee eks dee', '2019-06-21 11:01:57'), 
                                                                                                                  ('1', '1', 'hoi\r\n', '2019-06-21 11:07:25'), 
                                                                                                                  ('2', '2', 'fristi niBBa', '2019-06-21 11:08:08'), 
                                                                                                                  ('1', '1', 'was jouw prebleem', '2019-06-21 14:41:00'), 
                                                                                                                  ('1', '2', 'Mijn naam is bram', '2019-06-21 17:58:12'), 
                                                                                                                  ('1', '2', 'huh wuddufuq', '2019-06-21 17:58:29'), 
                                                                                                                  ('1', '1', 'huts a neef', '2019-06-21 17:59:27')");
            self::logMessage("created test replies", "OK");
        }
        catch(PDOException $e){
            self::logMessage("created test replies", "FAILURE");
            die("pdo exception, cannot connect to sql:<br> $e");
            //test change 7
        }
    }
}  