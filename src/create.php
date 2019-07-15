<?php 
    require_once('models/todo.php');
    require_once('db.php');
    $todo = new Todo(getPDO(), $_POST['text']);
    $todo -> save();
    header('Location: ' . (empty($_SERVER['https']) ? 'http': 'https') .'://'. $_SERVER['HTTP_HOST']);
?>