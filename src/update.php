<?php
require_once('models/todo.php');
require_once('models/repositories/todo_repository.php');
require_once('utils/db.php');
require_once('utils/post_parser.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $post_parser = new PostParser();
        $id = (int)$post_parser->getValue('id');
        $done = $post_parser->getValue('done');
        $dao = new TodoRepository(getPDO());
        $todo = $dao->findById($id);
        $todo->isDone = is_bool($done) ? $done : $done == strtolower('true');
        $dao->save($todo);
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit();
    } finally {
        $todo = null;
    }
}
header('Location: ' . (empty($_SERVER['https']) ? 'http' : 'https') . '://' . $_SERVER['HTTP_HOST']);
exit();
