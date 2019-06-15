<h1>TOPICS:</h1>
<?php
//Gedeeltelijk dummy code omdat de database nog niet zo ver is. Verder al wel functioneel. Gebrukersnamen worden ingeladen.
if(UserSession::isUserSignedIn()){
    //$topics = Database::GetTopicList();
    $topics = [ [0, "Hoeveel ICTers heb je nodig om een forum te bouwen?", 2],
                [1, "LOREM IPSUM DOLOR", 3]];
    for($i = 0; $i < sizeof($topics); $i++){
        echo '<a href="?p=showthread&topic='.$i.'">'.$topics[$i][1].'</a> - Gestart door: '.Database::getUsername($topics[$i][2]);
        echo '<br>';

    }
    echo();
}

?>