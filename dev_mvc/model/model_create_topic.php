<?php
//dit bestand bestaat grotendeels uit dummy code.
//Ik heb onvoldoende tijd gehad tijdens de afgelopen paar weken en het was extreem druk in de klas tijdens de les.
if(HUtils::issetPost(['topic_title', 'topic_content', 'topic_author']));
{
    $topic_title = $_GET['topic_title'];
    $topic_content = $_GET['topic_content'];
    $topic_author = $_GET['topic_author'];
    Database::createThread($topic_title, $topic_content, $topic_author);
}
?>