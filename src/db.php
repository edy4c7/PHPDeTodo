<?php 
function getPDO(){
    return new PDO('sqlite:/var/lib/sqlite3/todo.sqlite3'
        , null
        , null
        , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
?>