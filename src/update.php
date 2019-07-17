<?php
require_once('models/todo.php');
require_once('db.php');
if (isset($_GET['id'])) {
    try {
        $todo = Todo::find(getPDO(), $_GET['id']);
        $todo->isCompleted = !$todo->isCompleted;
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
