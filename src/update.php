<?php
require_once('models/todo.php');
require_once('db.php');
require_once('utils/post_parser.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $post_parser = new PostParser();
        $id = (int)$post_parser->getValue('id');
        $done = $post_parser->getValue('done');
        $todo = Todo::find(getPDO(), $id);
        $todo->isDone = is_bool($done) ? $done : $done == strtolower('true');
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
