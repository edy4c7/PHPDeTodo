<?php
require_once('models/todo.php');
require_once('db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $todo = new Todo(getPDO(), null, $_POST['text']);
        $todo->save();
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit();
    } finally {
        $todo = null;
    }
}
header('Location: ' . (empty($_SERVER['https']) ? 'http' : 'https') . '://' . $_SERVER['HTTP_HOST']);
exit();
