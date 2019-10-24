<?php
require_once('models/todo.php');
require_once('models/repositories/todo_repository.php');
require_once('utils/db.php');
require_once('utils/post_parser.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $post_parser = new PostParser();
        $dao = new TodoRepository(getPDO());
        $dao->save(new Todo(null, $post_parser->getValue('text')));
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit();
    } finally {
        $todo = null;
    }
}
header('Location: ' . (empty($_SERVER['https']) ? 'http' : 'https') . '://' . $_SERVER['HTTP_HOST']);
exit();
