<?php 
function getPDO(){
    return new PDO('sqlite:/var/lib/sqlite3/todo.sqlite3',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
?>